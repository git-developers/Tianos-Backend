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

namespace spec\Sylius\Bundle\CRUD_DUMMYBundle\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\UnitOfWork;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Attribute\AttributeType\SelectAttributeType;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeValue;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeValueInterface;
use Sylius\Component\CRUD_DUMMY\Repository\CRUD_DUMMYAttributeValueRepositoryInterface;

final class SelectCRUD_DUMMYAttributeChoiceRemoveListenerSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedWith(CRUD_DUMMYAttributeValue::class);
    }

    function it_removes_select_product_attribute_choices(
        LifecycleEventArgs $event,
        EntityManagerInterface $entityManager,
        UnitOfWork $unitOfWork,
        CRUD_DUMMYAttributeValueRepositoryInterface $productAttributeValueRepository,
        CRUD_DUMMYAttributeInterface $productAttribute,
        CRUD_DUMMYAttributeValueInterface $productAttributeValue
    ): void {
        $event->getEntity()->willReturn($productAttribute);
        $event->getEntityManager()->willReturn($entityManager);

        $productAttribute->getType()->willReturn(SelectAttributeType::TYPE);

        $entityManager->getUnitOfWork()->willReturn($unitOfWork);
        $unitOfWork->getEntityChangeSet($productAttribute)->willReturn([
            'configuration' => [
                ['choices' => [
                    '8ec40814-adef-4194-af91-5559b5f19236' => 'Banana',
                    '1739bc61-9e42-4c80-8b9a-f97f0579cccb' => 'Pineapple',
                ]],
                ['choices' => [
                    '8ec40814-adef-4194-af91-5559b5f19236' => 'Banana',
                ]],
            ],
        ]);

        $entityManager
            ->getRepository('Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeValue')
            ->willReturn($productAttributeValueRepository)
        ;
        $productAttributeValueRepository
            ->findByJsonChoiceKey('1739bc61-9e42-4c80-8b9a-f97f0579cccb')
            ->willReturn([$productAttributeValue])
        ;

        $productAttributeValue->getValue()->willReturn([
            '8ec40814-adef-4194-af91-5559b5f19236',
            '1739bc61-9e42-4c80-8b9a-f97f0579cccb',
        ]);

        $productAttributeValue->setValue(['8ec40814-adef-4194-af91-5559b5f19236'])->shouldBeCalled();
        $entityManager->flush()->shouldBeCalled();

        $this->postUpdate($event);
    }

    function it_does_not_remove_select_product_attribute_choices_if_there_is_only_added_new_choice(
        LifecycleEventArgs $event,
        EntityManagerInterface $entityManager,
        UnitOfWork $unitOfWork,
        CRUD_DUMMYAttributeInterface $productAttribute
    ): void {
        $event->getEntity()->willReturn($productAttribute);
        $event->getEntityManager()->willReturn($entityManager);

        $productAttribute->getType()->willReturn(SelectAttributeType::TYPE);

        $entityManager->getUnitOfWork()->willReturn($unitOfWork);
        $unitOfWork->getEntityChangeSet($productAttribute)->willReturn([
            'configuration' => [
                ['choices' => [
                    '8ec40814-adef-4194-af91-5559b5f19236' => 'Banana',
                ]],
                ['choices' => [
                    '8ec40814-adef-4194-af91-5559b5f19236' => 'Banana',
                    '1739bc61-9e42-4c80-8b9a-f97f0579cccb' => 'Pineapple',
                ]],
            ],
        ]);

        $entityManager
            ->getRepository('Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeValue')
            ->shouldNotBeCalled()
        ;
        $entityManager->flush()->shouldNotBeCalled();

        $this->postUpdate($event);
    }

    function it_does_not_remove_select_product_attribute_choices_if_there_is_only_changed_value(
        LifecycleEventArgs $event,
        EntityManagerInterface $entityManager,
        UnitOfWork $unitOfWork,
        CRUD_DUMMYAttributeInterface $productAttribute
    ): void {
        $event->getEntity()->willReturn($productAttribute);
        $event->getEntityManager()->willReturn($entityManager);

        $productAttribute->getType()->willReturn(SelectAttributeType::TYPE);

        $entityManager->getUnitOfWork()->willReturn($unitOfWork);
        $unitOfWork->getEntityChangeSet($productAttribute)->willReturn([
            'configuration' => [
                ['choices' => [
                    '8ec40814-adef-4194-af91-5559b5f19236' => 'Banana',
                    '1739bc61-9e42-4c80-8b9a-f97f0579cccb' => 'Pineapple',
                ]],
                ['choices' => [
                    '8ec40814-adef-4194-af91-5559b5f19236' => 'Banana',
                    '1739bc61-9e42-4c80-8b9a-f97f0579cccb' => 'Watermelon',
                ]],
            ],
        ]);

        $entityManager
            ->getRepository('Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeValue')
            ->shouldNotBeCalled()
        ;
        $entityManager->flush()->shouldNotBeCalled();

        $this->postUpdate($event);
    }

    function it_does_nothing_if_an_entity_is_not_a_product_attribute(
        EntityManagerInterface $entityManager,
        LifecycleEventArgs $event
    ): void {
        $event->getEntity()->willReturn('wrongObject');

        $entityManager
            ->getRepository('Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeValue')
            ->shouldNotBeCalled()
        ;
        $entityManager->flush()->shouldNotBeCalled();
    }

    function it_does_nothing_if_a_product_attribute_has_not_a_select_type(
        LifecycleEventArgs $event,
        EntityManagerInterface $entityManager,
        CRUD_DUMMYAttributeInterface $productAttribute
    ): void {
        $event->getEntity()->willReturn($productAttribute);
        $productAttribute->getType()->willReturn('wrongType');

        $entityManager
            ->getRepository('Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeValue')
            ->shouldNotBeCalled()
        ;
        $entityManager->flush()->shouldNotBeCalled();
    }
}
