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

namespace Bundle\TreeOneToManyBundle\DependencyInjection;

use Bundle\TreeOneToManyBundle\Doctrine\ORM\Driver as DoctrineORMDriver;
use Bundle\TreeOneToManyBundle\SyliusTreeOneToManyBundle;
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
        $rootNode = $treeBuilder->root('sylius_grid');

        $this->addDriversSection($rootNode);
        $this->addTemplatesSection($rootNode);
        $this->addOneToManysSection($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addDriversSection(ArrayNodeDefinition $node): void
    {
        $node
            ->children()
                ->arrayNode('drivers')
                    ->defaultValue([SyliusTreeOneToManyBundle::DRIVER_DOCTRINE_ORM])
                    ->prototype('enum')->values(SyliusTreeOneToManyBundle::getAvailableDrivers())->end()
                ->end()
            ->end()
        ;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addTemplatesSection(ArrayNodeDefinition $node): void
    {
        $node
            ->children()
                ->arrayNode('templates')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('filter')
                            ->useAttributeAsKey('name')
                            ->prototype('scalar')->end()
                        ->end()
                        ->arrayNode('action')
                            ->useAttributeAsKey('name')
                            ->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addOneToManysSection(ArrayNodeDefinition $node): void
    {
        $node
            ->children()
                ->arrayNode('grids')
                    ->useAttributeAsKey('code')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('extends')->cannotBeEmpty()->end()
                            ->arrayNode('driver')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('name')->cannotBeEmpty()->defaultValue(DoctrineORMDriver::NAME)->end()
                                    ->arrayNode('options')
                                        ->performNoDeepMerging()
                                        ->prototype('variable')->end()
                                        ->defaultValue([])
                                    ->end()
                                ->end()
                            ->end()
                            ->arrayNode('sorting')
                                ->performNoDeepMerging()
                                ->useAttributeAsKey('name')
                                ->prototype('enum')->values(['asc', 'desc'])->cannotBeEmpty()->end()
                            ->end()
                            ->arrayNode('limits')
                                ->performNoDeepMerging()
                                ->prototype('integer')->end()
                                ->defaultValue([10, 25, 50])
                            ->end()
                            ->arrayNode('fields')
                                ->useAttributeAsKey('name')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('type')->isRequired()->cannotBeEmpty()->end()
                                        ->scalarNode('label')->cannotBeEmpty()->end()
                                        ->scalarNode('path')->cannotBeEmpty()->end()
                                        ->scalarNode('sortable')->end()
                                        ->scalarNode('enabled')->defaultTrue()->end()
                                        ->scalarNode('position')->defaultValue(100)->end()
                                        ->arrayNode('options')
                                            ->performNoDeepMerging()
                                            ->prototype('variable')->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                            ->arrayNode('filters')
                                ->useAttributeAsKey('name')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('type')->isRequired()->cannotBeEmpty()->end()
                                        ->scalarNode('label')->cannotBeEmpty()->end()
                                        ->scalarNode('enabled')->defaultTrue()->end()
                                        ->scalarNode('template')->end()
                                        ->scalarNode('position')->defaultValue(100)->end()
                                        ->arrayNode('options')
                                            ->performNoDeepMerging()
                                            ->prototype('variable')->end()
                                        ->end()
                                        ->arrayNode('form_options')
                                            ->performNoDeepMerging()
                                            ->prototype('variable')->end()
                                        ->end()
                                        ->variableNode('default_value')->end()
                                    ->end()
                                ->end()
                            ->end()
                            ->arrayNode('actions')
                                ->useAttributeAsKey('name')
                                ->prototype('array')
                                    ->useAttributeAsKey('name')
                                    ->prototype('array')
                                        ->children()
                                            ->scalarNode('type')->isRequired()->end()
                                            ->scalarNode('label')->end()
                                            ->scalarNode('enabled')->defaultTrue()->end()
                                            ->scalarNode('icon')->end()
                                            ->scalarNode('position')->defaultValue(100)->end()
                                            ->arrayNode('options')
                                                ->performNoDeepMerging()
                                                ->prototype('variable')->end()
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
