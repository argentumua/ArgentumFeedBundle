<?php

namespace Argentum\FeedBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('argentum_feed');

        $rootNode
            ->children()
                ->arrayNode('channels')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('title')->isRequired()->end()
                            ->scalarNode('link')->isRequired()->end()
                            ->scalarNode('description')->isRequired()->end()
                            ->scalarNode('language')->end()
                            ->scalarNode('copyright')->end()
                            ->scalarNode('managingEditor')->end()
                            ->scalarNode('webMaster')->end()
                            ->scalarNode('pubDate')->end()
                            ->scalarNode('lastBuildDate')->end()
                            ->arrayNode('categories')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('title')->isRequired()->end()
                                        ->scalarNode('domain')->end()
                                    ->end()
                                ->end()
                            ->end()
                            ->scalarNode('generator')->end()
                            ->scalarNode('docs')->end()
                            ->arrayNode('cloud')
                                ->children()
                                    ->scalarNode('domain')->isRequired()->end()
                                    ->scalarNode('port')->isRequired()->end()
                                    ->scalarNode('path')->isRequired()->end()
                                    ->scalarNode('registerProcedure')->isRequired()->end()
                                    ->scalarNode('protocol')->isRequired()->end()
                                ->end()
                            ->end()
                            ->scalarNode('ttl')->end()
                            ->arrayNode('image')
                                ->children()
                                    ->scalarNode('url')->isRequired()->end()
                                    ->scalarNode('title')->isRequired()->end()
                                    ->scalarNode('link')->isRequired()->end()
                                    ->scalarNode('width')->end()
                                    ->scalarNode('height')->end()
                                    ->scalarNode('description')->end()
                                ->end()
                            ->end()
                            ->scalarNode('rating')->end()
                            ->arrayNode('textInput')
                                ->children()
                                    ->scalarNode('title')->isRequired()->end()
                                    ->scalarNode('description')->isRequired()->end()
                                    ->scalarNode('name')->isRequired()->end()
                                    ->scalarNode('link')->isRequired()->end()
                                ->end()
                            ->end()
                            ->arrayNode('skipHours')
                                ->prototype('integer')->end()
                            ->end()
                            ->arrayNode('skipDays')
                                ->prototype('scalar')->end()
                            ->end()
                            ->arrayNode('namespaces')
                                ->useAttributeAsKey('prefix')
                                ->prototype('scalar')->end()
                            ->end()
                            ->arrayNode('customElements')
                                ->prototype('scalar')->end()
                            ->end()
                            ->scalarNode('encoding')->defaultValue('utf-8')->end()
                            ->scalarNode('translationDomain')->defaultValue('messages')->end()
                            ->scalarNode('feed')->defaultValue('feed')->end()
                            ->scalarNode('renderer')->defaultValue('rss')->end()
                            ->arrayNode('provider')
                                ->children()
                                    ->scalarNode('repository')->end()
                                    ->scalarNode('service')->end()
                                    ->scalarNode('method')->isRequired()->end()
                                    ->arrayNode('arguments')
                                        ->prototype('scalar')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
