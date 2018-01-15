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

use Sylius\Component\CRUD_DUMMY\Checker\CRUD_DUMMYVariantsParityCheckerInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYVariantInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class CRUD_DUMMYVariantCombinationValidator extends ConstraintValidator
{
    /**
     * @var CRUD_DUMMYVariantsParityCheckerInterface
     */
    private $variantsParityChecker;

    /**
     * @param CRUD_DUMMYVariantsParityCheckerInterface $variantsParityChecker
     */
    public function __construct(CRUD_DUMMYVariantsParityCheckerInterface $variantsParityChecker)
    {
        $this->variantsParityChecker = $variantsParityChecker;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$value instanceof CRUD_DUMMYVariantInterface) {
            throw new UnexpectedTypeException($value, CRUD_DUMMYVariantInterface::class);
        }

        $product = $value->getCRUD_DUMMY();
        if (!$product->hasVariants() || !$product->hasOptions()) {
            return;
        }

        if ($this->variantsParityChecker->checkParity($value, $product)) {
            $this->context->addViolation($constraint->message);
        }
    }
}
