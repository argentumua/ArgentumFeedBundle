<?php

namespace Argentum\FeedBundle\Renderer;

use Argentum\FeedBundle\Feed\FeedInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * RssRenderer
 *
 * RSS 2.0 Specification: http://cyber.law.harvard.edu/rss/rss.html
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class RssRenderer implements RendererInterface
{
    /** @var EngineInterface */
    protected $templating;

    /**
     * Constructor.
     *
     * @param EngineInterface $templating
     */
    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    /**
     * Renders the feed and returns a string representation.
     *
     * @param FeedInterface $feed
     *
     * @return string
     */
    public function render(FeedInterface $feed)
    {
        $parameters = array(
            'feed' => $feed,
            'dateFormat' => \DateTime::RFC822,
        );

        return $this->templating->render('ArgentumFeedBundle::rss.xml.twig', $parameters);
    }
}
