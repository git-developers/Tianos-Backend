<?php

declare(strict_types=1);

namespace Sylius\Bundle\CRUD_DUMMYBundle\Form\Type;

use Sylius\Bundle\CRUD_DUMMYBundle\Form\EventSubscriber\BuildAttributesFormSubscriber;
use Sylius\Bundle\CRUD_DUMMYBundle\Form\EventSubscriber\CRUD_DUMMYOptionFieldSubscriber;
use Sylius\Bundle\CRUD_DUMMYBundle\Form\EventSubscriber\SimpleCRUD_DUMMYSubscriber;
use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Sylius\Component\CRUD_DUMMY\Resolver\CRUD_DUMMYVariantResolverInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Translation\Provider\TranslationLocaleProviderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

final class CRUD_DUMMY2Type extends AbstractResourceType
{
    /**
     * @var CRUD_DUMMYVariantResolverInterface
     */
    private $variantResolver;

    /**
     * @var FactoryInterface
     */
    private $attributeValueFactory;

    /**
     * @var TranslationLocaleProviderInterface
     */
    private $localeProvider;

    /**
     * @param string $dataClass
     * @param array|string[] $validationGroups
     * @param CRUD_DUMMYVariantResolverInterface $variantResolver
     * @param FactoryInterface $attributeValueFactory
     * @param TranslationLocaleProviderInterface $localeProvider
     */
    public function __construct(
        string $dataClass,
        array $validationGroups,
        CRUD_DUMMYVariantResolverInterface $variantResolver,
        FactoryInterface $attributeValueFactory,
        TranslationLocaleProviderInterface $localeProvider
    ) {
        parent::__construct($dataClass, $validationGroups);

        $this->variantResolver = $variantResolver;
        $this->attributeValueFactory = $attributeValueFactory;
        $this->localeProvider = $localeProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->addEventSubscriber(new CRUD_DUMMYOptionFieldSubscriber($this->variantResolver))
            ->addEventSubscriber(new SimpleCRUD_DUMMYSubscriber())
            ->addEventSubscriber(new BuildAttributesFormSubscriber($this->attributeValueFactory, $this->localeProvider))
            ->add('enabled', CheckboxType::class, [
                'required' => false,
                'label' => 'sylius.form.product.enabled',
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => CRUD_DUMMYTranslationType::class,
                'label' => 'sylius.form.product.translations',
            ])
            ->add('attributes', CollectionType::class, [
                'entry_type' => CRUD_DUMMYAttributeValueType::class,
                'required' => false,
                'prototype' => true,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
            ])
            ->add('associations', CRUD_DUMMYAssociationsType::class, [
                'label' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'sylius_product';
    }
}
