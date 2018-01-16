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
use Bundle\CRUD_DUMMYBundle\Validator\Constraint\UniqueSimpleCRUD_DUMMYCode;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYInterface;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYVariantInterface;
use Component\CRUD_DUMMY\Repository\CRUD_DUMMYVariantRepositoryInterface;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

final class UniqueSimpleCRUD_DUMMYCodeValidatorSpec extends ObjectBehavior
{
    function let(ExecutionContextInterface $context, CRUD_DUMMYVariantRepositoryInterface $productVariantRepository): void
    {
        $this->beConstructedWith($productVariantRepository);
        $this->initialize($context);
    }

    function it_is_a_constraint_validator(): void
    {
        $this->shouldImplement(ConstraintValidator::class);
    }

    function it_does_not_add_violation_if_product_is_configurable(
        ExecutionContextInterface $context,
        CRUD_DUMMYInterface $product
    ): void {
        $constraint = new UniqueSimpleCRUD_DUMMYCode([
            'message' => 'Simple product code has to be unique',
        ]);

        $product->isSimple()->willReturn(false);

        $context->buildViolation(Argument::any())->shouldNotBeCalled();

        $this->validate($product, $constraint);
    }

    function it_does_not_add_violation_if_product_is_simple_but_code_has_not_been_used_among_neither_producs_nor_product_variants(
        ExecutionContextInterface $context,
        CRUD_DUMMYInterface $product,
        CRUD_DUMMYVariantRepositoryInterface $productVariantRepository
    ): void {
        $constraint = new UniqueSimpleCRUD_DUMMYCode([
            'message' => 'Simple product code has to be unique',
        ]);

        $product->isSimple()->willReturn(true);
        $product->getCode()->willReturn('AWESOME_PRODUCT');

        $context->buildViolation(Argument::any())->shouldNotBeCalled();

        $productVariantRepository->findOneBy(['code' => 'AWESOME_PRODUCT'])->willReturn(null);

        $this->validate($product, $constraint);
    }

    function it_does_not_add_violation_if_product_is_simple_code_has_been_used_but_for_the_same_product(
        ExecutionContextInterface $context,
        CRUD_DUMMYInterface $product,
        CRUD_DUMMYVariantInterface $existingCRUD_DUMMYVariant,
        CRUD_DUMMYVariantRepositoryInterface $productVariantRepository
    ): void {
        $constraint = new UniqueSimpleCRUD_DUMMYCode([
            'message' => 'Simple product code has to be unique',
        ]);

        $product->isSimple()->willReturn(true);
        $product->getCode()->willReturn('AWESOME_PRODUCT');
        $product->getId()->willReturn(1);

        $context->buildViolation(Argument::any())->shouldNotBeCalled();

        $productVariantRepository->findOneBy(['code' => 'AWESOME_PRODUCT'])->willReturn($existingCRUD_DUMMYVariant);
        $existingCRUD_DUMMYVariant->getCRUD_DUMMY()->willReturn($product);

        $this->validate($product, $constraint);
    }

    function it_add_violation_if_product_is_simple_and_code_has_been_used_in_other_product_variant(
        ExecutionContextInterface $context,
        CRUD_DUMMYInterface $product,
        CRUD_DUMMYInterface $existingCRUD_DUMMY,
        CRUD_DUMMYVariantInterface $existingCRUD_DUMMYVariant,
        CRUD_DUMMYVariantRepositoryInterface $productVariantRepository,
        ConstraintViolationBuilderInterface $constraintViolationBuilder
    ): void {
        $constraint = new UniqueSimpleCRUD_DUMMYCode([
            'message' => 'Simple product code has to be unique',
        ]);

        $product->isSimple()->willReturn(true);
        $product->getCode()->willReturn('AWESOME_PRODUCT');
        $product->getId()->willReturn(1);

        $context->buildViolation('Simple product code has to be unique', Argument::cetera())->willReturn($constraintViolationBuilder);

        $constraintViolationBuilder->atPath('code')->shouldBeCalled()->willReturn($constraintViolationBuilder);
        $constraintViolationBuilder->addViolation()->shouldBeCalled()->willReturn($constraintViolationBuilder);

        $productVariantRepository->findOneBy(['code' => 'AWESOME_PRODUCT'])->willReturn($existingCRUD_DUMMYVariant);
        $existingCRUD_DUMMYVariant->getCRUD_DUMMY()->willReturn($existingCRUD_DUMMY);
        $existingCRUD_DUMMY->getId()->willReturn(2);

        $this->validate($product, $constraint);
    }
}
