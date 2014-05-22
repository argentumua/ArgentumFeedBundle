<?php

namespace Argentum\FeedBundle;

use Argentum\FeedBundle\DependencyInjection\Compiler\AddFeedsPass;
use Argentum\FeedBundle\DependencyInjection\Compiler\AddRenderersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * ArgentumFeedBundle
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class ArgentumFeedBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddFeedsPass());
        $container->addCompilerPass(new AddRenderersPass());
    }
}
