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

namespace Sylius\Bundle\CRUD_DUMMYBundle\DependencyInjection;

use Sylius\Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYAssociationType;
use Sylius\Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYAssociationTypeTranslationType;
use Sylius\Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYAssociationTypeType;
use Sylius\Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYOptionTranslationType;
use Sylius\Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYOptionType;
use Sylius\Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYOptionValueTranslationType;
use Sylius\Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYOptionValueType;
use Sylius\Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYTranslationType;
use Sylius\Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMY2Type;
use Sylius\Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYVariantTranslationType;
use Sylius\Bundle\CRUD_DUMMYBundle\Form\Type\CRUD_DUMMYVariantType;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Bundle\ResourceBundle\ResourceBundle;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMY;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAssociation;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAssociationInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAssociationType as CRUD_DUMMYAssociationTypeModel;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAssociationTypeInterface as CRUD_DUMMYAssociationTypeModelInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAssociationTypeTranslation;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAssociationTypeTranslationInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYOption;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYOptionInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYOptionTranslation;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYOptionTranslationInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYOptionValue;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYOptionValueInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYOptionValueTranslation;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYOptionValueTranslationInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYTranslation;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYTranslationInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYVariant;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYVariantInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYVariantTranslation;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYVariantTranslationInterface;
use Sylius\Component\Resource\Factory\Factory;
use Sylius\Component\Resource\Factory\TranslatableFactory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sylius_product');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')->defaultValue(ResourceBundle::DRIVER_DOCTRINE_ORM)->end()
            ->end()
        ;

        $this->addResourcesSection($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addResourcesSection(ArrayNodeDefinition $node): void
    {
        $node
            ->children()
                ->arrayNode('resources')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('product')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(CRUD_DUMMY::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(CRUD_DUMMYInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(CRUD_DUMMY2Type::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(CRUD_DUMMYTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(CRUD_DUMMYTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(CRUD_DUMMYTranslationType::class)->cannotBeEmpty()->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('product_variant')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(CRUD_DUMMYVariant::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(CRUD_DUMMYVariantInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(CRUD_DUMMYVariantType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(CRUD_DUMMYVariantTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(CRUD_DUMMYVariantTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(CRUD_DUMMYVariantTranslationType::class)->cannotBeEmpty()->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('product_option')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(CRUD_DUMMYOption::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(CRUD_DUMMYOptionInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(CRUD_DUMMYOptionType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(CRUD_DUMMYOptionTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(CRUD_DUMMYOptionTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(CRUD_DUMMYOptionTranslationType::class)->cannotBeEmpty()->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('product_option_value')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(CRUD_DUMMYOptionValue::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(CRUD_DUMMYOptionValueInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(CRUD_DUMMYOptionValueType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->variableNode('option_value')->end()
                                        ->arrayNode('classes')
                                            ->isRequired()
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(CRUD_DUMMYOptionValueTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(CRUD_DUMMYOptionValueTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->cannotBeEmpty()->end()
                                                ->scalarNode('form')->defaultValue(CRUD_DUMMYOptionValueTranslationType::class)->cannotBeEmpty()->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('product_association')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(CRUD_DUMMYAssociation::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(CRUD_DUMMYAssociationInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(CRUD_DUMMYAssociationType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('product_association_type')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(CRUD_DUMMYAssociationTypeModel::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(CRUD_DUMMYAssociationTypeModelInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(CRUD_DUMMYAssociationTypeType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(CRUD_DUMMYAssociationTypeTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(CRUD_DUMMYAssociationTypeTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(CRUD_DUMMYAssociationTypeTranslationType::class)->cannotBeEmpty()->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
