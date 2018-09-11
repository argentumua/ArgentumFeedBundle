<?php

namespace Argentum\FeedBundle\Feed;

/**
 * Feedable
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
interface Feedable
{
    /**
     * Returns FeedItem instance.
     *
     * @param FeedInterface $feed
     *
     * @return FeedItem
     */
    public function getFeedItem(FeedInterface $feed);
}
