<?php

declare(strict_types=1);

namespace Bundle\ClientBundle\DependencyInjection;

use Bundle\ClientBundle\Form\Type\ClientAssociationType;
use Bundle\ClientBundle\Form\Type\ClientAssociationTypeTranslationType;
use Bundle\ClientBundle\Form\Type\ClientAssociationTypeType;
use Bundle\ClientBundle\Form\Type\ClientOptionTranslationType;
use Bundle\ClientBundle\Form\Type\ClientOptionType;
use Bundle\ClientBundle\Form\Type\ClientOptionValueTranslationType;
use Bundle\ClientBundle\Form\Type\ClientOptionValueType;
use Bundle\ClientBundle\Form\Type\ClientTranslationType;
use Bundle\ClientBundle\Form\Type\Client2Type;
use Bundle\ClientBundle\Form\Type\ClientVariantTranslationType;
use Bundle\ClientBundle\Form\Type\ClientVariantType;
use Bundle\ResourceBundle\Controller\ResourceController;
use Bundle\ResourceBundle\ResourceBundle;
use Component\University\Model\University;
use Component\University\Model\ClientAssociation;
use Component\University\Model\ClientAssociationInterface;
use Component\University\Model\ClientAssociationType as ClientAssociationTypeModel;
use Component\University\Model\ClientAssociationTypeInterface as ClientAssociationTypeModelInterface;
use Component\University\Model\ClientAssociationTypeTranslation;
use Component\University\Model\ClientAssociationTypeTranslationInterface;
use Component\University\Model\ClientInterface;
use Component\University\Model\ClientOption;
use Component\University\Model\ClientOptionInterface;
use Component\University\Model\ClientOptionTranslation;
use Component\University\Model\ClientOptionTranslationInterface;
use Component\University\Model\ClientOptionValue;
use Component\University\Model\ClientOptionValueInterface;
use Component\University\Model\ClientOptionValueTranslation;
use Component\University\Model\ClientOptionValueTranslationInterface;
use Component\University\Model\ClientTranslation;
use Component\University\Model\ClientTranslationInterface;
use Component\University\Model\ClientVariant;
use Component\University\Model\ClientVariantInterface;
use Component\University\Model\ClientVariantTranslation;
use Component\University\Model\ClientVariantTranslationInterface;
use Component\Resource\Factory\Factory;
use Component\Resource\Factory\TranslatableFactory;
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
                                        ->scalarNode('model')->defaultValue(University::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ClientInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(Client2Type::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(ClientTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(ClientTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(ClientTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(ClientVariant::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ClientVariantInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(ClientVariantType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(ClientVariantTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(ClientVariantTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(ClientVariantTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(ClientOption::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ClientOptionInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(ClientOptionType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(ClientOptionTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(ClientOptionTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(ClientOptionTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(ClientOptionValue::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ClientOptionValueInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(ClientOptionValueType::class)->cannotBeEmpty()->end()
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
                                                ->scalarNode('model')->defaultValue(ClientOptionValueTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(ClientOptionValueTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->cannotBeEmpty()->end()
                                                ->scalarNode('form')->defaultValue(ClientOptionValueTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(ClientAssociation::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ClientAssociationInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(ClientAssociationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(ClientAssociationTypeModel::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ClientAssociationTypeModelInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(ClientAssociationTypeType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(ClientAssociationTypeTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(ClientAssociationTypeTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(ClientAssociationTypeTranslationType::class)->cannotBeEmpty()->end()
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
