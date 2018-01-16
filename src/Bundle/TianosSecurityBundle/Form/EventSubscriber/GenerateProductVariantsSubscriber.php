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

use Component\CRUD_DUMMY\Generator\CRUD_DUMMYVariantGeneratorInterface;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Webmozart\Assert\Assert;

final class GenerateCRUD_DUMMYVariantsSubscriber implements EventSubscriberInterface
{
    /**
     * @var CRUD_DUMMYVariantGeneratorInterface
     */
    private $generator;

    /**
     * @param CRUD_DUMMYVariantGeneratorInterface $generator
     */
    public function __construct(CRUD_DUMMYVariantGeneratorInterface $generator)
    {
        $this->generator = $generator;
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

        $this->generator->generate($product);
    }
}
