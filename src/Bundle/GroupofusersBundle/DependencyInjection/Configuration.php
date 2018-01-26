<?php

declare(strict_types=1);

namespace Bundle\GroupofusersBundle\DependencyInjection;

use Bundle\GroupofusersBundle\Form\Type\GroupofusersAssociationType;
use Bundle\GroupofusersBundle\Form\Type\GroupofusersAssociationTypeTranslationType;
use Bundle\GroupofusersBundle\Form\Type\GroupofusersAssociationTypeType;
use Bundle\GroupofusersBundle\Form\Type\GroupofusersOptionTranslationType;
use Bundle\GroupofusersBundle\Form\Type\GroupofusersOptionType;
use Bundle\GroupofusersBundle\Form\Type\GroupofusersOptionValueTranslationType;
use Bundle\GroupofusersBundle\Form\Type\GroupofusersOptionValueType;
use Bundle\GroupofusersBundle\Form\Type\GroupofusersTranslationType;
use Bundle\GroupofusersBundle\Form\Type\Groupofusers2Type;
use Bundle\GroupofusersBundle\Form\Type\GroupofusersVariantTranslationType;
use Bundle\GroupofusersBundle\Form\Type\GroupofusersVariantType;
use Bundle\ResourceBundle\Controller\ResourceController;
use Bundle\ResourceBundle\ResourceBundle;
use Component\Groupofusers\Model\Groupofusers;
use Component\Groupofusers\Model\GroupofusersAssociation;
use Component\Groupofusers\Model\GroupofusersAssociationInterface;
use Component\Groupofusers\Model\GroupofusersAssociationType as GroupofusersAssociationTypeModel;
use Component\Groupofusers\Model\GroupofusersAssociationTypeInterface as GroupofusersAssociationTypeModelInterface;
use Component\Groupofusers\Model\GroupofusersAssociationTypeTranslation;
use Component\Groupofusers\Model\GroupofusersAssociationTypeTranslationInterface;
use Component\Groupofusers\Model\GroupofusersInterface;
use Component\Groupofusers\Model\GroupofusersOption;
use Component\Groupofusers\Model\GroupofusersOptionInterface;
use Component\Groupofusers\Model\GroupofusersOptionTranslation;
use Component\Groupofusers\Model\GroupofusersOptionTranslationInterface;
use Component\Groupofusers\Model\GroupofusersOptionValue;
use Component\Groupofusers\Model\GroupofusersOptionValueInterface;
use Component\Groupofusers\Model\GroupofusersOptionValueTranslation;
use Component\Groupofusers\Model\GroupofusersOptionValueTranslationInterface;
use Component\Groupofusers\Model\GroupofusersTranslation;
use Component\Groupofusers\Model\GroupofusersTranslationInterface;
use Component\Groupofusers\Model\GroupofusersVariant;
use Component\Groupofusers\Model\GroupofusersVariantInterface;
use Component\Groupofusers\Model\GroupofusersVariantTranslation;
use Component\Groupofusers\Model\GroupofusersVariantTranslationInterface;
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
                                        ->scalarNode('model')->defaultValue(Groupofusers::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(GroupofusersInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(Groupofusers2Type::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(GroupofusersTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(GroupofusersTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(GroupofusersTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(GroupofusersVariant::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(GroupofusersVariantInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(GroupofusersVariantType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(GroupofusersVariantTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(GroupofusersVariantTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(GroupofusersVariantTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(GroupofusersOption::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(GroupofusersOptionInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(GroupofusersOptionType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(GroupofusersOptionTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(GroupofusersOptionTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(GroupofusersOptionTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(GroupofusersOptionValue::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(GroupofusersOptionValueInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(GroupofusersOptionValueType::class)->cannotBeEmpty()->end()
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
                                                ->scalarNode('model')->defaultValue(GroupofusersOptionValueTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(GroupofusersOptionValueTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->cannotBeEmpty()->end()
                                                ->scalarNode('form')->defaultValue(GroupofusersOptionValueTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(GroupofusersAssociation::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(GroupofusersAssociationInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(GroupofusersAssociationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(GroupofusersAssociationTypeModel::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(GroupofusersAssociationTypeModelInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(GroupofusersAssociationTypeType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(GroupofusersAssociationTypeTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(GroupofusersAssociationTypeTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(GroupofusersAssociationTypeTranslationType::class)->cannotBeEmpty()->end()
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
