<?php

namespace App\Ptrio\MessageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ptrio_message');

        $rootNode
            ->children()
                ->arrayNode('firebase')
                    ->children()
                        ->scalarNode('api_url')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('server_key')->isRequired()->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}