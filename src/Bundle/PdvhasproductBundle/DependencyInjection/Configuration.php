<?php

declare(strict_types=1);

namespace Bundle\PdvhasproductBundle\DependencyInjection;

use Bundle\PdvhasproductBundle\Form\Type\PdvhasproductAssociationType;
use Bundle\PdvhasproductBundle\Form\Type\PdvhasproductAssociationTypeTranslationType;
use Bundle\PdvhasproductBundle\Form\Type\PdvhasproductAssociationTypeType;
use Bundle\PdvhasproductBundle\Form\Type\PdvhasproductOptionTranslationType;
use Bundle\PdvhasproductBundle\Form\Type\PdvhasproductOptionType;
use Bundle\PdvhasproductBundle\Form\Type\PdvhasproductOptionValueTranslationType;
use Bundle\PdvhasproductBundle\Form\Type\PdvhasproductOptionValueType;
use Bundle\PdvhasproductBundle\Form\Type\PdvhasproductTranslationType;
use Bundle\PdvhasproductBundle\Form\Type\Pdvhasproduct2Type;
use Bundle\PdvhasproductBundle\Form\Type\PdvhasproductVariantTranslationType;
use Bundle\PdvhasproductBundle\Form\Type\PdvhasproductVariantType;
use Bundle\ResourceBundle\Controller\ResourceController;
use Bundle\ResourceBundle\ResourceBundle;
use Component\Pdvhasproduct\Model\Pdvhasproduct;
use Component\Pdvhasproduct\Model\PdvhasproductAssociation;
use Component\Pdvhasproduct\Model\PdvhasproductAssociationInterface;
use Component\Pdvhasproduct\Model\PdvhasproductAssociationType as PdvhasproductAssociationTypeModel;
use Component\Pdvhasproduct\Model\PdvhasproductAssociationTypeInterface as PdvhasproductAssociationTypeModelInterface;
use Component\Pdvhasproduct\Model\PdvhasproductAssociationTypeTranslation;
use Component\Pdvhasproduct\Model\PdvhasproductAssociationTypeTranslationInterface;
use Component\Pdvhasproduct\Model\PdvhasproductInterface;
use Component\Pdvhasproduct\Model\PdvhasproductOption;
use Component\Pdvhasproduct\Model\PdvhasproductOptionInterface;
use Component\Pdvhasproduct\Model\PdvhasproductOptionTranslation;
use Component\Pdvhasproduct\Model\PdvhasproductOptionTranslationInterface;
use Component\Pdvhasproduct\Model\PdvhasproductOptionValue;
use Component\Pdvhasproduct\Model\PdvhasproductOptionValueInterface;
use Component\Pdvhasproduct\Model\PdvhasproductOptionValueTranslation;
use Component\Pdvhasproduct\Model\PdvhasproductOptionValueTranslationInterface;
use Component\Pdvhasproduct\Model\PdvhasproductTranslation;
use Component\Pdvhasproduct\Model\PdvhasproductTranslationInterface;
use Component\Pdvhasproduct\Model\PdvhasproductVariant;
use Component\Pdvhasproduct\Model\PdvhasproductVariantInterface;
use Component\Pdvhasproduct\Model\PdvhasproductVariantTranslation;
use Component\Pdvhasproduct\Model\PdvhasproductVariantTranslationInterface;
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
                                        ->scalarNode('model')->defaultValue(Pdvhasproduct::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(PdvhasproductInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(Pdvhasproduct2Type::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(PdvhasproductTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(PdvhasproductTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(PdvhasproductTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(PdvhasproductVariant::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(PdvhasproductVariantInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(PdvhasproductVariantType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(PdvhasproductVariantTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(PdvhasproductVariantTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(PdvhasproductVariantTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(PdvhasproductOption::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(PdvhasproductOptionInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(PdvhasproductOptionType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(PdvhasproductOptionTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(PdvhasproductOptionTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(PdvhasproductOptionTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(PdvhasproductOptionValue::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(PdvhasproductOptionValueInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(PdvhasproductOptionValueType::class)->cannotBeEmpty()->end()
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
                                                ->scalarNode('model')->defaultValue(PdvhasproductOptionValueTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(PdvhasproductOptionValueTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->cannotBeEmpty()->end()
                                                ->scalarNode('form')->defaultValue(PdvhasproductOptionValueTranslationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(PdvhasproductAssociation::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(PdvhasproductAssociationInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(PdvhasproductAssociationType::class)->cannotBeEmpty()->end()
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
                                        ->scalarNode('model')->defaultValue(PdvhasproductAssociationTypeModel::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(PdvhasproductAssociationTypeModelInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(PdvhasproductAssociationTypeType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(PdvhasproductAssociationTypeTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(PdvhasproductAssociationTypeTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(PdvhasproductAssociationTypeTranslationType::class)->cannotBeEmpty()->end()
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
