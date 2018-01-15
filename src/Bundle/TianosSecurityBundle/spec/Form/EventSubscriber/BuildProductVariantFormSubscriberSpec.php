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

namespace spec\Sylius\Bundle\CRUD_DUMMYBundle\Form\EventSubscriber;

use Doctrine\Common\Collections\ArrayCollection;
use PhpSpec\ObjectBehavior;
use Sylius\Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYOptionValueCollectionType;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYOptionInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYOptionValueInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYVariantInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

final class BuildCRUD_DUMMYVariantFormSubscriberSpec extends ObjectBehavior
{
    function let(FormFactoryInterface $factory): void
    {
        $this->beConstructedWith($factory);
    }

    function it_subscribes_to_event(): void
    {
        static::getSubscribedEvents()->shouldReturn(
            [FormEvents::PRE_SET_DATA => 'preSetData']
        );
    }

    function it_adds_options_on_pre_set_data_event_with_configurable_options(
        FormEvent $event,
        FormFactoryInterface $factory,
        FormInterface $form,
        FormInterface $optionsForm,
        CRUD_DUMMYInterface $variable,
        CRUD_DUMMYOptionInterface $options,
        CRUD_DUMMYOptionValueInterface $optionValue,
        CRUD_DUMMYVariantInterface $variant
    ): void {
        $event->getForm()->willReturn($form);
        $event->getData()->willReturn($variant);

        $variant->getCRUD_DUMMY()->willReturn($variable);
        $variant->getOptionValues()->willReturn(new ArrayCollection([$optionValue->getWrappedObject()]));
        $variable->getOptions()->willReturn(new ArrayCollection([$options->getWrappedObject()]));
        $variable->hasOptions()->willReturn(true);

        $factory->createNamed(
            'optionValues',
            CRUD_DUMMYOptionValueCollectionType::class,
            new ArrayCollection([$optionValue->getWrappedObject()]),
            [
                'options' => new ArrayCollection([$options->getWrappedObject()]),
                'auto_initialize' => false,
                'disabled' => false,
            ]
        )->willReturn($optionsForm);

        $form->add($optionsForm)->shouldBeCalled();

        $this->preSetData($event);
    }

    function it_adds_options_on_pre_set_data_event_without_configurable_options(
        FormEvent $event,
        FormFactoryInterface $factory,
        FormInterface $form,
        FormInterface $optionsForm,
        CRUD_DUMMYInterface $variable,
        CRUD_DUMMYOptionInterface $options,
        CRUD_DUMMYOptionValueInterface $optionValue,
        CRUD_DUMMYVariantInterface $variant
    ): void {
        $this->beConstructedWith($factory, true);

        $event->getForm()->willReturn($form);
        $event->getData()->willReturn($variant);

        $variant->getCRUD_DUMMY()->willReturn($variable);
        $variant->getOptionValues()->willReturn(new ArrayCollection([$optionValue->getWrappedObject()]));
        $variable->getOptions()->willReturn(new ArrayCollection([$options->getWrappedObject()]));
        $variable->hasOptions()->willReturn(true);

        $factory->createNamed(
            'optionValues',
            CRUD_DUMMYOptionValueCollectionType::class,
            new ArrayCollection([$optionValue->getWrappedObject()]),
            [
                'options' => new ArrayCollection([$options->getWrappedObject()]),
                'auto_initialize' => false,
                'disabled' => true,
            ]
        )->willReturn($optionsForm);

        $form->add($optionsForm)->shouldBeCalled();

        $this->preSetData($event);
    }
}
