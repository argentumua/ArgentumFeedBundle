<?php

namespace Argentum\FeedBundle\Renderer;

use Argentum\FeedBundle\Feed\FeedInterface;

/**
 * RendererInterface
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
interface RendererInterface
{
    /**
     * Renders the feed and returns a string representation.
     *
     * @param FeedInterface $feed
     *
     * @return string
     */
    public function render(FeedInterface $feed);
}
