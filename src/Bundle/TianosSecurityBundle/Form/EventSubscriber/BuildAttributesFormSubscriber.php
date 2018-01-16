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

use Component\Attribute\Model\AttributeValueInterface;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeInterface;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeValueInterface;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYInterface;
use Component\Resource\Factory\FactoryInterface;
use Component\Resource\Translation\Provider\TranslationLocaleProviderInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Webmozart\Assert\Assert;

final class BuildAttributesFormSubscriber implements EventSubscriberInterface
{
    /**
     * @var FactoryInterface
     */
    private $attributeValueFactory;

    /**
     * @var TranslationLocaleProviderInterface
     */
    private $localeProvider;

    /**
     * @param FactoryInterface $attributeValueFactory
     * @param TranslationLocaleProviderInterface $localeProvider
     */
    public function __construct(
        FactoryInterface $attributeValueFactory,
        TranslationLocaleProviderInterface $localeProvider
    ) {
        $this->attributeValueFactory = $attributeValueFactory;
        $this->localeProvider = $localeProvider;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::POST_SUBMIT => 'postSubmit',
        ];
    }

    /**
     * @param FormEvent $event
     *
     * @throws \InvalidArgumentException
     */
    public function preSetData(FormEvent $event): void
    {
        /** @var CRUD_DUMMYInterface $product */
        $product = $event->getData();

        Assert::isInstanceOf($product, CRUD_DUMMYInterface::class);

        $defaultLocaleCode = $this->localeProvider->getDefaultLocaleCode();

        $attributes = $product->getAttributes()->filter(
            function (CRUD_DUMMYAttributeValueInterface $attribute) use ($defaultLocaleCode) {
                return $attribute->getLocaleCode() === $defaultLocaleCode;
            }
        );

        foreach ($attributes as $attribute) {
            $this->resolveLocalizedAttributes($product, $attribute);
        }
    }

    /**
     * @param FormEvent $event
     *
     * @throws \InvalidArgumentException
     */
    public function postSubmit(FormEvent $event): void
    {
        /** @var CRUD_DUMMYInterface $product */
        $product = $event->getData();

        Assert::isInstanceOf($product, CRUD_DUMMYInterface::class);

        /** @var AttributeValueInterface $attribute */
        foreach ($product->getAttributes() as $attribute) {
            if (null === $attribute->getValue()) {
                $product->removeAttribute($attribute);
            }
        }
    }

    /**
     * @param CRUD_DUMMYInterface $product
     * @param CRUD_DUMMYAttributeValueInterface $attribute
     */
    private function resolveLocalizedAttributes(CRUD_DUMMYInterface $product, CRUD_DUMMYAttributeValueInterface $attribute): void
    {
        $localeCodes = $this->localeProvider->getDefinedLocalesCodes();

        foreach ($localeCodes as $localeCode) {
            if (!$product->hasAttributeByCodeAndLocale($attribute->getCode(), $localeCode)) {
                $attributeValue = $this->createCRUD_DUMMYAttributeValue($attribute->getAttribute(), $localeCode);
                $product->addAttribute($attributeValue);
            }
        }
    }

    /**
     * @param CRUD_DUMMYAttributeInterface $attribute
     * @param string $localeCode
     *
     * @return CRUD_DUMMYAttributeValueInterface
     */
    private function createCRUD_DUMMYAttributeValue(
        CRUD_DUMMYAttributeInterface $attribute,
        string $localeCode
    ): CRUD_DUMMYAttributeValueInterface {
        /** @var CRUD_DUMMYAttributeValueInterface $attributeValue */
        $attributeValue = $this->attributeValueFactory->createNew();
        $attributeValue->setAttribute($attribute);
        $attributeValue->setLocaleCode($localeCode);

        return $attributeValue;
    }
}
