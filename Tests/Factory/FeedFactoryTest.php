<?php

namespace Argentum\FeedBundle\Tests\Factory;

use Argentum\FeedBundle\Factory\FeedFactory;
use Argentum\FeedBundle\Feed\Feed;

/**
 * FeedFactoryTest
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testAddFeed()
    {
        $factory = $this->getFactory();
        $feed = $this->getMock('Argentum\FeedBundle\Feed\FeedInterface');
        $factory->addFeed('feed', $feed);
        $this->assertSame($feed, $factory->getFeed('feed'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetFeedUnregistered()
    {
        $this->getFactory()->getFeed('unregistered');
    }

    public function testAddRenderer()
    {
        $factory = $this->getFactory();
        $renderer = $this->getMock('Argentum\FeedBundle\Renderer\RendererInterface');
        $factory->addRenderer('renderer', $renderer);
        $this->assertSame($renderer, $factory->getRenderer('renderer'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetRendererUnregistered()
    {
        $this->getFactory()->getRenderer('unregistered');
    }

    public function testCreateFeedWithProviderService()
    {
        $channels = array(
            'news' => array(
                'title' => 'title',
                'link' => 'http://example.com',
                'description' => 'description',
                'feed' => 'feed',
                'renderer' => 'renderer',
                'element' => 'value',
                'provider' => array(
                    'service' => 'feed_provider',
                    'method' => 'get',
                ),
            )
        );

        $item = $this->getMock('Argentum\FeedBundle\Feed\FeedItem');
        $feedable = $this->getMock('Argentum\FeedBundle\Feed\Feedable');
        $feedable
            ->expects($this->once())
            ->method('getFeedItem')
            ->will($this->returnValue($item));
        $feedableItems = array($feedable);

        $provider = $this->getMock('stdClass', array('get'));
        $provider
            ->expects($this->once())
            ->method('get')
            ->will($this->returnValue($feedableItems));

        $services = array(
            'feed_provider' => $provider,
        );

        $factory = $this->getFactory($channels, $services);
        $factory->addFeed('feed', new Feed());
        $factory->addRenderer('renderer', $this->getMock('Argentum\FeedBundle\Renderer\RendererInterface'));

        $feed = $factory->createFeed('news');
        $this->assertInstanceOf('Argentum\FeedBundle\Feed\FeedInterface', $feed);
        $this->assertEquals($channels['news']['title'], $feed->getTitle());
        $this->assertEquals($channels['news']['link'], $feed->getLink());
        $this->assertEquals($channels['news']['description'], $feed->getDescription());
        $this->assertContains($channels['news']['element'], $feed->getChannel());
        $this->assertArrayNotHasKey('feed', $feed->getChannel());
        $this->assertArrayNotHasKey('renderer', $feed->getChannel());
        $this->assertArrayNotHasKey('provider', $feed->getChannel());

        $items = $feed->getItems();
        $this->assertCount(1, $items);
        $this->assertSame($item, $items[0]);
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testCreateFeedWithProviderServiceWithoutMethod()
    {
        $channels = array(
            'news' => array(
                'title' => 'title',
                'link' => 'http://example.com',
                'description' => 'description',
                'feed' => 'feed',
                'renderer' => 'renderer',
                'provider' => array(
                    'service' => 'feed_provider',
                    'method' => 'get',
                ),
            )
        );

        $provider = $this->getMock('stdClass');

        $services = array(
            'feed_provider' => $provider,
        );

        $factory = $this->getFactory($channels, $services);
        $factory->addFeed('feed', new Feed());
        $factory->addRenderer('renderer', $this->getMock('Argentum\FeedBundle\Renderer\RendererInterface'));

        $factory->createFeed('news');
    }

    public function testCreateFeedWithProviderRepository()
    {
        $channels = array(
            'news' => array(
                'title' => 'title',
                'link' => 'http://example.com',
                'description' => 'description',
                'feed' => 'feed',
                'renderer' => 'renderer',
                'element' => 'value',
                'provider' => array(
                    'repository' => 'News',
                    'method' => 'get',
                ),
            )
        );

        $item = $this->getMock('Argentum\FeedBundle\Feed\FeedItem');
        $feedable = $this->getMock('Argentum\FeedBundle\Feed\Feedable');
        $feedable
            ->expects($this->once())
            ->method('getFeedItem')
            ->will($this->returnValue($item));
        $feedableItems = array($feedable);

        $repository = $this->getMock('stdClass', array('get'));
        $repository
            ->expects($this->once())
            ->method('get')
            ->will($this->returnValue($feedableItems));

        $entityManager = $this->getMock('stdClass', array('getRepository'));
        $entityManager
            ->expects($this->once())
            ->method('getRepository')
            ->with('News')
            ->will($this->returnValue($repository));

        $services = array(
            'doctrine.orm.default_entity_manager' => $entityManager,
        );

        $factory = $this->getFactory($channels, $services);
        $factory->addFeed('feed', new Feed());
        $factory->addRenderer('renderer', $this->getMock('Argentum\FeedBundle\Renderer\RendererInterface'));

        $feed = $factory->createFeed('news');
        $this->assertInstanceOf('Argentum\FeedBundle\Feed\FeedInterface', $feed);
        $this->assertEquals($channels['news']['title'], $feed->getTitle());
        $this->assertEquals($channels['news']['link'], $feed->getLink());
        $this->assertEquals($channels['news']['description'], $feed->getDescription());
        $this->assertContains($channels['news']['element'], $feed->getChannel());
        $this->assertArrayNotHasKey('feed', $feed->getChannel());
        $this->assertArrayNotHasKey('renderer', $feed->getChannel());
        $this->assertArrayNotHasKey('provider', $feed->getChannel());

        $items = $feed->getItems();
        $this->assertCount(1, $items);
        $this->assertSame($item, $items[0]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateFeedWithEmptyProvider()
    {
        $channels = array(
            'news' => array(
                'title' => 'title',
                'link' => 'http://example.com',
                'description' => 'description',
                'feed' => 'feed',
                'renderer' => 'renderer',
                'provider' => array(
                    'method' => 'get',
                ),
            )
        );

        $factory = $this->getFactory($channels);
        $factory->addFeed('feed', new Feed());
        $factory->addRenderer('renderer', $this->getMock('Argentum\FeedBundle\Renderer\RendererInterface'));

        $factory->createFeed('news');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateFeedUndefined()
    {
        $this->getFactory()->createFeed('undefined');
    }

    private function getFactory($channels = null, $services = null)
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');

        if (!is_null($channels)) {
            $container
                ->expects($this->atLeastOnce())
                ->method('getParameter')
                ->with('argentum_feed.channels')
                ->will($this->returnValue($channels));
        }

        if (!is_null($services) && is_array($services)) {
            foreach ($services as $id => $service) {
                $container
                    ->expects($this->atLeastOnce())
                    ->method('get')
                    ->with($id)
                    ->will($this->returnValue($service));
            }
        }

        $factory = new FeedFactory($container);
        $factory->setContainer($container);

        return $factory;
    }
}
