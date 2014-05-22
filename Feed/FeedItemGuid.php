<?php

namespace Argentum\FeedBundle\Feed;

/**
 * FeedItemGuid
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedItemGuid
{
    protected $link;

    protected $isPermaLink;

    /**
     * Constructor.
     *
     * @param string $link
     * @param boolean $isPermaLink
     */
    public function __construct($link, $isPermaLink = true)
    {
        $this->setLink($link);
        $this->setPermaLink($isPermaLink);
    }

    /**
     * Sets link.
     *
     * @param string $link
     *
     * @return FeedItemGuid
     *
     * @throws \InvalidArgumentException
     */
    public function setLink($link)
    {
        if (strlen($link) == 0) {
            throw new \InvalidArgumentException(sprintf('Guid link should not be empty'));
        }

        $this->link = $link;

        return $this;
    }

    /**
     * Returns link.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Sets isPermaLink.
     *
     * @param boolean $isPermaLink
     *
     * @return FeedItemGuid
     */
    public function setPermaLink($isPermaLink)
    {
        $this->isPermaLink = $isPermaLink;

        return $this;
    }

    /**
     * Returns isPermaLink.
     *
     * @return boolean
     */
    public function isPermaLink()
    {
        return $this->isPermaLink;
    }
}
