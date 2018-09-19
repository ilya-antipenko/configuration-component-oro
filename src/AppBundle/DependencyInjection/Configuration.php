<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('app');

        $rootNode
            ->children()
                ->arrayNode('presenter')
                    ->isRequired()
                    ->children()
                        ->scalarNode('first_name')->isRequired()->end()
                        ->scalarNode('last_name')->isRequired()->end()
                        ->scalarNode('company')->defaultValue('Oro Inc.')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;

    }
}
