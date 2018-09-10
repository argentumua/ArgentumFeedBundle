<?php

namespace Argentum\FeedBundle\Factory;

use Argentum\FeedBundle\Feed\FeedInterface;
use Argentum\FeedBundle\Feed\FeedItem;
use Argentum\FeedBundle\Renderer\RendererInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * FeedFactory
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedFactory implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var FeedInterface[]
     */
    private $feeds;

    /**
     * @var RendererInterface[]
     */
    private $renderers;

    /**
     * Constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->feeds     = array();
        $this->renderers = array();
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Adds a new feed class.
     *
     * @param string        $name
     * @param FeedInterface $feed
     */
    public function addFeed($name, FeedInterface $feed)
    {
        $this->feeds[$name] = $feed;
    }

    /**
     * Returns feed class.
     *
     * @param string $name
     *
     * @return FeedInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getFeed($name)
    {
        if (!isset($this->feeds[$name])) {
            throw new \InvalidArgumentException(sprintf('Feed "%s" is not registered', $name));
        }

        return $this->feeds[$name];
    }

    /**
     * Adds a new renderer class.
     *
     * @param string            $name
     * @param RendererInterface $renderer
     */
    public function addRenderer($name, RendererInterface $renderer)
    {
        $this->renderers[$name] = $renderer;
    }

    /**
     * Returns renderer class.
     *
     * @param string $name
     *
     * @return RendererInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getRenderer($name)
    {
        if (!isset($this->renderers[$name])) {
            throw new \InvalidArgumentException(sprintf('Feed renderer "%s" is not registered', $name));
        }

        return $this->renderers[$name];
    }

    /**
     * Creates a new feed instance.
     *
     * @param string $name         A predefined channel name
     * @param string $rendererName A registered renderer name
     *
     * @throws \InvalidArgumentException
     * @return FeedInterface
     */
    public function createFeed($name, $rendererName = null)
    {
        $channels = $this->container->getParameter('argentum_feed.channels');

        if (!isset($channels[$name])) {
            throw new \InvalidArgumentException(sprintf('No such feed: %s', $name));
        }

        $config   = $channels[$name];
        $feedName = $config['feed'];
        unset($config['feed']);

        $config['renderer'] = $this->getRenderer($rendererName ?: $config['renderer']);

        if (isset($config['provider'])) {
            $config['items'] = $this->fetchProviderItems($config['provider']);
            unset($config['provider']);
        }

        return $this->getFeed($feedName)->create($config);
//
//        $feed = clone $this->getFeed($feedName);
//
//        return $feed->loadFromArray($config);
    }

    /**
     * Returns provider items.
     *
     * @param array $parameters
     *
     * @return array[]|object[]|FeedItem[]
     *
     * @throws \InvalidArgumentException
     * @throws \BadMethodCallException
     */
    protected function fetchProviderItems($parameters)
    {
        if (isset($parameters['repository'])) {
            $provider = $this->container
                ->get('doctrine.orm.default_entity_manager')
                ->getRepository($parameters['repository'])
            ;
        } elseif (isset($parameters['service'])) {
            $provider = $this->container->get($parameters['service']);
        } else {
            throw new \InvalidArgumentException(
                sprintf('You should specify either "repository" or "service" for the provider.')
            );
        }

        $method    = $parameters['method'];
        $arguments = isset($parameters['arguments']) ? $parameters['arguments'] : array();

        if (!method_exists($provider, $method)) {
            throw new \BadMethodCallException(
                sprintf('Class "%s" does not contain method "%s"', get_class($provider), $method)
            );
        }

        return call_user_func_array(array( $provider, $method ), $arguments);
    }
}
