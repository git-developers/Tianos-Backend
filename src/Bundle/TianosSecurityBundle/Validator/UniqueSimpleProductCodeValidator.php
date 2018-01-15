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

namespace Sylius\Bundle\CRUD_DUMMYBundle\Validator;

use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYInterface;
use Sylius\Component\CRUD_DUMMY\Repository\CRUD_DUMMYVariantRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class UniqueSimpleCRUD_DUMMYCodeValidator extends ConstraintValidator
{
    /**
     * @var CRUD_DUMMYVariantRepositoryInterface
     */
    private $productVariantRepository;

    /**
     * @param CRUD_DUMMYVariantRepositoryInterface $productVariantRepository
     */
    public function __construct(CRUD_DUMMYVariantRepositoryInterface $productVariantRepository)
    {
        $this->productVariantRepository = $productVariantRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$value instanceof CRUD_DUMMYInterface) {
            throw new UnexpectedTypeException($value, CRUD_DUMMYInterface::class);
        }

        if (!$value->isSimple()) {
            return;
        }

        $existingCRUD_DUMMYVariant = $this->productVariantRepository->findOneBy(['code' => $value->getCode()]);

        if (null !== $existingCRUD_DUMMYVariant && $existingCRUD_DUMMYVariant->getCRUD_DUMMY()->getId() !== $value->getId()) {
            $this->context->buildViolation($constraint->message)
                ->atPath('code')
                ->addViolation()
            ;
        }
    }
}
