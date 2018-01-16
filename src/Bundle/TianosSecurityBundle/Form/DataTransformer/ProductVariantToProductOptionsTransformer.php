<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bundle\CRUD_DUMMYBundle\Form\DataTransformer;

use Component\CRUD_DUMMY\Model\CRUD_DUMMYInterface;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYOptionValueInterface;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYVariantInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

final class CRUD_DUMMYVariantToCRUD_DUMMYOptionsTransformer implements DataTransformerInterface
{
    /**
     * @var CRUD_DUMMYInterface
     */
    private $product;

    /**
     * @param CRUD_DUMMYInterface $product
     */
    public function __construct(CRUD_DUMMYInterface $product)
    {
        $this->product = $product;
    }

    /**
     * {@inheritdoc}
     *
     * @throws UnexpectedTypeException
     */
    public function transform($value): array
    {
        if (null === $value) {
            return [];
        }

        if (!$value instanceof CRUD_DUMMYVariantInterface) {
            throw new UnexpectedTypeException($value, CRUD_DUMMYVariantInterface::class);
        }

        return array_combine(
            array_map(function (CRUD_DUMMYOptionValueInterface $productOptionValue) {
                return $productOptionValue->getOptionCode();
            }, $value->getOptionValues()->toArray()),
            $value->getOptionValues()->toArray()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value): ?CRUD_DUMMYVariantInterface
    {
        if (null === $value || '' === $value) {
            return null;
        }

        if (!is_array($value) && !$value instanceof \Traversable && !$value instanceof \ArrayAccess) {
            throw new UnexpectedTypeException($value, '\Traversable or \ArrayAccess');
        }

        return $this->matches($value);
    }

    /**
     * @param CRUD_DUMMYOptionValueInterface[] $optionValues
     *
     * @return CRUD_DUMMYVariantInterface|null
     *
     * @throws TransformationFailedException
     */
    private function matches(array $optionValues): ?CRUD_DUMMYVariantInterface
    {
        foreach ($this->product->getVariants() as $variant) {
            foreach ($optionValues as $optionValue) {
                if (null === $optionValue || !$variant->hasOptionValue($optionValue)) {
                    continue 2;
                }
            }

            return $variant;
        }

        throw new TransformationFailedException(sprintf(
            'Variant "%s" not found for product %s',
            !empty($optionValues[0]) ? $optionValues[0]->getCode() : '',
            $this->product->getCode()
        ));
    }
}
