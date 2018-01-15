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

namespace spec\Sylius\Bundle\CRUD_DUMMYBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYOptionValueInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYVariantInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

final class CRUD_DUMMYVariantToCRUD_DUMMYOptionsTransformerSpec extends ObjectBehavior
{
    function let(CRUD_DUMMYInterface $variable): void
    {
        $this->beConstructedWith($variable);
    }

    function it_is_a_data_transformer(): void
    {
        $this->shouldImplement(DataTransformerInterface::class);
    }

    function it_transforms_null_to_array(): void
    {
        $this->transform(null)->shouldReturn([]);
    }

    function it_does_not_transform_not_supported_data_and_throw_exception(): void
    {
        $this->shouldThrow(UnexpectedTypeException::class)->duringTransform([]);
    }

    function it_transforms_variant_into_variant_options(CRUD_DUMMYVariantInterface $variant, Collection $optionValues): void
    {
        $variant->getOptionValues()->willReturn($optionValues);
        $optionValues->toArray()->willReturn([]);

        $this->transform($variant)->shouldReturn([]);
    }

    function it_reverse_transforms_null_into_null(): void
    {
        $this->reverseTransform(null)->shouldReturn(null);
    }

    function it_reverse_transforms_empty_string_into_null(): void
    {
        $this->reverseTransform('')->shouldReturn(null);
    }

    function it_does_not_reverse_transform_not_supported_data_and_throw_exception(): void
    {
        $this
            ->shouldThrow(UnexpectedTypeException::class)
            ->duringReverseTransform(new \stdClass())
        ;
    }

    function it_throws_exception_when_trying_to_reverse_transform_variable_without_variants(
        CRUD_DUMMYInterface $variable,
        CRUD_DUMMYOptionValueInterface $optionValue
    ): void {
        $variable->getVariants()->willReturn(new ArrayCollection([]));
        $variable->getCode()->willReturn('example');

        $this
            ->shouldThrow(TransformationFailedException::class)
            ->duringReverseTransform([$optionValue]);
    }

    function it_reverse_transforms_variable_with_variants_if_options_match(
        CRUD_DUMMYInterface $variable,
        CRUD_DUMMYVariantInterface $variant,
        CRUD_DUMMYOptionValueInterface $optionValue
    ): void {
        $variable->getVariants()->willReturn(new ArrayCollection([$variant->getWrappedObject()]));

        $variant->hasOptionValue($optionValue)->willReturn(true);

        $this->reverseTransform([$optionValue])->shouldReturn($variant);
    }

    function it_throws_exception_when_trying_to_reverse_transform_variable_with_variants_if_options_not_match(
        CRUD_DUMMYInterface $variable,
        CRUD_DUMMYVariantInterface $variant,
        CRUD_DUMMYOptionValueInterface $optionValue
    ): void {
        $variable->getVariants()->willReturn(new ArrayCollection([$variant->getWrappedObject()]));
        $variable->getCode()->willReturn('example');

        $variant->hasOptionValue($optionValue)->willReturn(false);

        $this
            ->shouldThrow(TransformationFailedException::class)
            ->duringReverseTransform([$optionValue]);
    }

    function it_throws_exception_when_trying_to_reverse_transform_variable_with_variants_if_options_are_missing(
        CRUD_DUMMYInterface $variable,
        CRUD_DUMMYVariantInterface $variant
    ): void {
        $variable->getVariants()->willReturn(new ArrayCollection([$variant->getWrappedObject()]));
        $variable->getCode()->willReturn('example');

        $this
            ->shouldThrow(TransformationFailedException::class)
            ->duringReverseTransform([null]);
    }
}
