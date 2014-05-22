<?php

namespace Argentum\FeedBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * AddRenderersPass
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class AddRenderersPass implements CompilerPassInterface
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

        $taggedRenderers = $container->findTaggedServiceIds('argentum_feed.renderer');
        foreach ($taggedRenderers as $id => $tags) {
            foreach ($tags as $attributes) {
                if (empty($attributes['alias'])) {
                    throw new \InvalidArgumentException(
                        sprintf(
                            'The alias is not defined in the "argentum_feed.renderer" tag for the service "%s"',
                            $id
                        )
                    );
                }
                $definition->addMethodCall('addRenderer', array($attributes['alias'], new Reference($id)));
            }
        }
    }
}
