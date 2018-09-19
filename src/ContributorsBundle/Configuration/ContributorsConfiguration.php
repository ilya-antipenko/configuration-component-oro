<?php

namespace ContributorsBundle\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class ContributorsConfiguration implements ConfigurationInterface
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
                ->arrayNode('contributors')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('name')->isRequired()->end()
                            ->scalarNode('email')->isRequired()->end()
                            ->scalarNode('github')->end()
                            ->scalarNode('company')->defaultValue('Oro Inc.')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;

    }
}
