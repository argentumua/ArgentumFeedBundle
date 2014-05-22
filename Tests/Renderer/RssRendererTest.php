<?php

namespace Argentum\FeedBundle\Tests\Renderer;

use Argentum\FeedBundle\Renderer\RssRenderer;

/**
 * RssRendererTest
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class RssRendererTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $templating = $this->getMock('Symfony\Bundle\FrameworkBundle\Templating\EngineInterface');
        $templating
            ->expects($this->once())
            ->method('render')
            ->with('ArgentumFeedBundle::rss.xml.twig')
            ->will($this->returnValue('rendered'));

        $feed = $this->getMock('Argentum\FeedBundle\Feed\FeedInterface');

        $renderer = new RssRenderer($templating);
        $result = $renderer->render($feed);
        $this->assertEquals('rendered', $result);
    }
}
