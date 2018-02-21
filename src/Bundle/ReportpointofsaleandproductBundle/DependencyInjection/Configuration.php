<?php

declare(strict_types=1);

namespace Bundle\ReportpointofsaleandproductBundle\DependencyInjection;

use Bundle\ReportpointofsaleandproductBundle\Form\Type\ReportpointofsaleandproductAssociationType;
use Bundle\ReportpointofsaleandproductBundle\Form\Type\ReportpointofsaleandproductAssociationTypeTranslationType;
use Bundle\ReportpointofsaleandproductBundle\Form\Type\ReportpointofsaleandproductAssociationTypeType;
use Bundle\ReportpointofsaleandproductBundle\Form\Type\ReportpointofsaleandproductOptionTranslationType;
use Bundle\ReportpointofsaleandproductBundle\Form\Type\ReportpointofsaleandproductOptionType;
use Bundle\ReportpointofsaleandproductBundle\Form\Type\ReportpointofsaleandproductOptionValueTranslationType;
use Bundle\ReportpointofsaleandproductBundle\Form\Type\ReportpointofsaleandproductOptionValueType;
use Bundle\ReportpointofsaleandproductBundle\Form\Type\ReportpointofsaleandproductTranslationType;
use Bundle\ReportpointofsaleandproductBundle\Form\Type\Reportpointofsaleandproduct2Type;
use Bundle\ReportpointofsaleandproductBundle\Form\Type\ReportpointofsaleandproductVariantTranslationType;
use Bundle\ReportpointofsaleandproductBundle\Form\Type\ReportpointofsaleandproductVariantType;
use Bundle\ResourceBundle\Controller\ResourceController;
use Bundle\ResourceBundle\ResourceBundle;
use Component\Reportpointofsaleandproduct\Model\Reportpointofsaleandproduct;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductAssociation;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductAssociationInterface;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductAssociationType as ReportpointofsaleandproductAssociationTypeModel;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductAssociationTypeInterface as ReportpointofsaleandproductAssociationTypeModelInterface;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductAssociationTypeTranslation;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductAssociationTypeTranslationInterface;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductInterface;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductOption;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductOptionInterface;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductOptionTranslation;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductOptionTranslationInterface;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductOptionValue;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductOptionValueInterface;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductOptionValueTranslation;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductOptionValueTranslationInterface;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductTranslation;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductTranslationInterface;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductVariant;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductVariantInterface;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductVariantTranslation;
use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductVariantTranslationInterface;
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
                                        ->scalarNode('model')->defaultValue(Reportpointofsaleandproduct::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ReportpointofsaleandproductInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(Reportpointofsaleandproduct2Type::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(ReportpointofsaleandproductTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(ReportpointofsaleandproductTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(ReportpointofsaleandproductTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(ReportpointofsaleandproductVariant::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ReportpointofsaleandproductVariantInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(ReportpointofsaleandproductVariantType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(ReportpointofsaleandproductVariantTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(ReportpointofsaleandproductVariantTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(ReportpointofsaleandproductVariantTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(ReportpointofsaleandproductOption::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ReportpointofsaleandproductOptionInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(ReportpointofsaleandproductOptionType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(ReportpointofsaleandproductOptionTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(ReportpointofsaleandproductOptionTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(ReportpointofsaleandproductOptionTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(ReportpointofsaleandproductOptionValue::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ReportpointofsaleandproductOptionValueInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(ReportpointofsaleandproductOptionValueType::class)->cannotBeEmpty()->end()
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
                                                ->scalarNode('model')->defaultValue(ReportpointofsaleandproductOptionValueTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(ReportpointofsaleandproductOptionValueTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->cannotBeEmpty()->end()
                                                ->scalarNode('form')->defaultValue(ReportpointofsaleandproductOptionValueTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(ReportpointofsaleandproductAssociation::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ReportpointofsaleandproductAssociationInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(ReportpointofsaleandproductAssociationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(ReportpointofsaleandproductAssociationTypeModel::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(ReportpointofsaleandproductAssociationTypeModelInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(ReportpointofsaleandproductAssociationTypeType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(ReportpointofsaleandproductAssociationTypeTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(ReportpointofsaleandproductAssociationTypeTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(ReportpointofsaleandproductAssociationTypeTranslationType::class)->cannotBeEmpty()->end()
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
