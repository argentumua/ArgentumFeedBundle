<?php

namespace Argentum\FeedBundle\Feed;

/**
 * FeedItemSource
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedItemSource
{
    protected $title;

    protected $url;

    /**
     * Constructor.
     *
     * @param string $title
     * @param string $url
     */
    public function __construct($title, $url = null)
    {
        $this->setTitle($title);
        $this->setUrl($url);
    }

    /**
     * Sets title.
     *
     * @param string $title
     *
     * @return FeedItemSource
     *
     * @throws \InvalidArgumentException
     */
    public function setTitle($title)
    {
        if (strlen($title) == 0) {
            throw new \InvalidArgumentException(sprintf('Source title should not be empty'));
        }

        $this->title = $title;

        return $this;
    }

    /**
     * Returns title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets url.
     *
     * @param string $url
     *
     * @return FeedItemSource
     *
     * @throws \InvalidArgumentException
     */
    public function setUrl($url)
    {
        if (!is_null($url)) {
            if (!preg_match('@^https?://@', $url)) {
                throw new \InvalidArgumentException(sprintf('Invalid url: %s', $url));
            }

            $this->url = $url;
        } else {
            $this->url = null;
        }

        return $this;
    }

    /**
     * Returns url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
