<?php

namespace Argentum\FeedBundle\Tests;

use Argentum\FeedBundle\ArgentumFeedBundle;

/**
 * ArgentumFeedBundleTest
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class ArgentumFeedBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $containerBuilder = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');

        $containerBuilder
            ->expects($this->at(0))
            ->method('addCompilerPass')
            ->with($this->isInstanceOf('Argentum\FeedBundle\DependencyInjection\Compiler\AddFeedsPass'));

        $containerBuilder
            ->expects($this->at(1))
            ->method('addCompilerPass')
            ->with($this->isInstanceOf('Argentum\FeedBundle\DependencyInjection\Compiler\AddRenderersPass'));

        $bundle = new ArgentumFeedBundle();
        $bundle->build($containerBuilder);
    }
}
