<?php

namespace Argentum\FeedBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * AddFeedsPass
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class AddFeedsPass implements CompilerPassInterface
{
    /**
     * Modifies the container before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @throws \InvalidArgumentException
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('argentum_feed.factory')) {
            return;
        }

        $definition = $container->getDefinition('argentum_feed.factory');

        $taggedFeeds = $container->findTaggedServiceIds('argentum_feed.feed');
        foreach ($taggedFeeds as $id => $tags) {
            foreach ($tags as $attributes) {
                if (empty($attributes['alias'])) {
                    throw new \InvalidArgumentException(
                        sprintf(
                            'The alias is not defined in the "argentum_feed.feed" tag for the service "%s"',
                            $id
                        )
                    );
                }
                $definition->addMethodCall('addFeed', array($attributes['alias'], new Reference($id)));
            }
        }
    }
}
