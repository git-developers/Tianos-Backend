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

namespace Sylius\Bundle\CRUD_DUMMYBundle\Form\EventSubscriber;

use Sylius\Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYVariantType;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Valid;
use Webmozart\Assert\Assert;

final class SimpleCRUD_DUMMYSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit',
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function preSetData(FormEvent $event): void
    {
        /** @var CRUD_DUMMYInterface $product */
        $product = $event->getData();

        Assert::isInstanceOf($product, CRUD_DUMMYInterface::class);

        if ($product->isSimple()) {
            $form = $event->getForm();

            $form->add('variant', CRUD_DUMMYVariantType::class, [
                'property_path' => 'variants[0]',
                'constraints' => [
                    new Valid(),
                ],
            ]);
            $form->remove('options');
        }
    }

    /**
     * @param FormEvent $event
     */
    public function preSubmit(FormEvent $event): void
    {
        $data = $event->getData();

        if (empty($data) || !array_key_exists('variant', $data) || !array_key_exists('code', $data)) {
            return;
        }

        $data['variant']['code'] = $data['code'];

        $event->setData($data);
    }
}
