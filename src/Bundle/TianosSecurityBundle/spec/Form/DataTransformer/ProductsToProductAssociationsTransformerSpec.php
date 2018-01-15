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
use PhpSpec\ObjectBehavior;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAssociationInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAssociationTypeInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYInterface;
use Sylius\Component\CRUD_DUMMY\Repository\CRUD_DUMMYRepositoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\DataTransformerInterface;

final class CRUD_DUMMYsToCRUD_DUMMYAssociationsTransformerSpec extends ObjectBehavior
{
    function let(
        FactoryInterface $productAssociationFactory,
        CRUD_DUMMYRepositoryInterface $productRepository,
        RepositoryInterface $productAssociationTypeRepository
    ): void {
        $this->beConstructedWith(
            $productAssociationFactory,
            $productRepository,
            $productAssociationTypeRepository
        );
    }

    function it_is_a_data_transformer(): void
    {
        $this->shouldImplement(DataTransformerInterface::class);
    }

    function it_transforms_null_to_empty_string(): void
    {
        $this->transform(null)->shouldReturn('');
    }

    function it_transforms_product_associations_to_array(
        CRUD_DUMMYAssociationInterface $productAssociation,
        CRUD_DUMMYAssociationTypeInterface $productAssociationType,
        CRUD_DUMMYInterface $firstAssociatedCRUD_DUMMY,
        CRUD_DUMMYInterface $secondAssociatedCRUD_DUMMY
    ): void {
        $productAssociation->getType()->willReturn($productAssociationType);
        $productAssociation->getAssociatedCRUD_DUMMYs()->willReturn(
            new ArrayCollection([
                $firstAssociatedCRUD_DUMMY->getWrappedObject(),
                $secondAssociatedCRUD_DUMMY->getWrappedObject(),
            ])
        );

        $firstAssociatedCRUD_DUMMY->getCode()->willReturn('FIRST');
        $secondAssociatedCRUD_DUMMY->getCode()->willReturn('SECOND');

        $productAssociationType->getCode()->willReturn('accessories');

        $this->transform(new ArrayCollection([$productAssociation->getWrappedObject()]))->shouldReturn([
            'accessories' => 'FIRST,SECOND',
        ]);
    }

    function it_reverse_transforms_null_into_null(): void
    {
        $this->reverseTransform(null)->shouldReturn(null);
    }

    function it_reverse_transforms_empty_string_into_null(): void
    {
        $this->reverseTransform('')->shouldReturn(null);
    }
}
