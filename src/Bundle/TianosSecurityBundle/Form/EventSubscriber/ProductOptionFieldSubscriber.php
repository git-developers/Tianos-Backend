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

namespace Bundle\CRUD_DUMMYBundle\Form\EventSubscriber;

use Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYOptionChoiceType;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYInterface;
use Component\CRUD_DUMMY\Resolver\CRUD_DUMMYVariantResolverInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Webmozart\Assert\Assert;

final class CRUD_DUMMYOptionFieldSubscriber implements EventSubscriberInterface
{
    /**
     * @var CRUD_DUMMYVariantResolverInterface
     */
    private $variantResolver;

    /**
     * @param CRUD_DUMMYVariantResolverInterface $variantResolver
     */
    public function __construct(CRUD_DUMMYVariantResolverInterface $variantResolver)
    {
        $this->variantResolver = $variantResolver;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
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

        $form = $event->getForm();

        /** Options should be disabled for configurable product if it has at least one defined variant */
        $disableOptions = (null !== $this->variantResolver->getVariant($product)) && $product->hasVariants();

        $form->add('options', CRUD_DUMMYOptionChoiceType::class, [
            'required' => false,
            'disabled' => $disableOptions,
            'multiple' => true,
            'label' => 'sylius.form.product.options',
        ]);
    }
}
