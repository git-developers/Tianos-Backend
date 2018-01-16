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

namespace spec\Bundle\CRUD_DUMMYBundle\Validator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bundle\CRUD_DUMMYBundle\Validator\Constraint\CRUD_DUMMYVariantCombination;
use Component\CRUD_DUMMY\Checker\CRUD_DUMMYVariantsParityCheckerInterface;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYInterface;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYVariantInterface;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

final class CRUD_DUMMYVariantCombinationValidatorSpec extends ObjectBehavior
{
    function let(ExecutionContextInterface $context, CRUD_DUMMYVariantsParityCheckerInterface $variantsParityChecker): void
    {
        $this->beConstructedWith($variantsParityChecker);
        $this->initialize($context);
    }

    function it_is_a_constraint_validator(): void
    {
        $this->shouldImplement(ConstraintValidator::class);
    }

    function it_does_not_add_violation_if_product_does_not_have_options(
        ExecutionContextInterface $context,
        CRUD_DUMMYInterface $product,
        CRUD_DUMMYVariantInterface $variant,
        CRUD_DUMMYVariantsParityCheckerInterface $variantsParityChecker
    ): void {
        $constraint = new CRUD_DUMMYVariantCombination([
            'message' => 'Variant with given options already exists',
        ]);

        $variant->getCRUD_DUMMY()->willReturn($product);

        $product->hasVariants()->willReturn(true);
        $product->hasOptions()->willReturn(false);

        $variantsParityChecker->checkParity($variant, $product)->willReturn(false);

        $context->addViolation(Argument::any())->shouldNotBeCalled();

        $this->validate($variant, $constraint);
    }

    function it_does_not_add_violation_if_product_does_not_have_variants(
        ExecutionContextInterface $context,
        CRUD_DUMMYInterface $product,
        CRUD_DUMMYVariantInterface $variant,
        CRUD_DUMMYVariantsParityCheckerInterface $variantsParityChecker
    ): void {
        $constraint = new CRUD_DUMMYVariantCombination([
            'message' => 'Variant with given options already exists',
        ]);

        $variant->getCRUD_DUMMY()->willReturn($product);

        $product->hasVariants()->willReturn(false);
        $product->hasOptions()->willReturn(true);

        $context->addViolation(Argument::any())->shouldNotBeCalled();

        $variantsParityChecker->checkParity($variant, $product)->willReturn(false);

        $this->validate($variant, $constraint);
    }

    function it_adds_violation_if_variant_with_given_same_options_already_exists(
        ExecutionContextInterface $context,
        CRUD_DUMMYInterface $product,
        CRUD_DUMMYVariantInterface $variant,
        CRUD_DUMMYVariantsParityCheckerInterface $variantsParityChecker
    ): void {
        $constraint = new CRUD_DUMMYVariantCombination([
            'message' => 'Variant with given options already exists',
        ]);

        $variant->getCRUD_DUMMY()->willReturn($product);

        $product->hasVariants()->willReturn(true);
        $product->hasOptions()->willReturn(true);

        $variantsParityChecker->checkParity($variant, $product)->willReturn(true);

        $context->addViolation('Variant with given options already exists', Argument::any())->shouldBeCalled();

        $this->validate($variant, $constraint);
    }
}
