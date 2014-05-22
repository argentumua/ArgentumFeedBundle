<?php

namespace Argentum\FeedBundle\Feed;

/**
 * FeedImage
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedImage
{
    protected $url;

    protected $title;

    protected $link;

    protected $width;

    protected $height;

    protected $description;

    /**
     * Constructor.
     *
     * @param string $url
     * @param string $title
     * @param string $link
     */
    public function __construct($url, $title, $link)
    {
        $this->setUrl($url);
        $this->setTitle($title);
        $this->setLink($link);
    }

    /**
     * Creates an instance initialized with given values.
     *
     * @param array $values
     *
     * @return FeedImage
     */
    public static function createFromArray(array $values)
    {
        $image = new self($values['url'], $values['title'], $values['link']);

        if (isset($values['width'])) {
            $image->setWidth($values['width']);
        }

        if (isset($values['height'])) {
            $image->setHeight($values['height']);
        }

        if (isset($values['description'])) {
            $image->setDescription($values['description']);
        }

        return $image;
    }

    /**
     * Sets url.
     * 
     * @param string $url
     *
     * @return FeedImage
     *
     * @throws \InvalidArgumentException
     */
    public function setUrl($url)
    {
        if (strlen($url) == 0) {
            throw new \InvalidArgumentException(sprintf('Image URL should not be empty'));
        }

        $this->url = $url;

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

    /**
     * Sets title.
     *
     * @param string $title
     *
     * @return FeedImage
     *
     * @throws \InvalidArgumentException
     */
    public function setTitle($title)
    {
        if (strlen($title) == 0) {
            throw new \InvalidArgumentException(sprintf('Image title should not be empty'));
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
     * Sets link.
     *
     * @param string $link
     *
     * @return FeedImage
     *
     * @throws \InvalidArgumentException
     */
    public function setLink($link)
    {
        if (strlen($link) == 0) {
            throw new \InvalidArgumentException(sprintf('Image link should not be empty'));
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
     * Sets width.
     *
     * @param integer $width
     *
     * @return FeedImage
     *
     * @throws \InvalidArgumentException
     */
    public function setWidth($width)
    {
        if (!is_null($width)) {
            if (intval($width) < 0) {
                throw new \InvalidArgumentException(sprintf('Invalid width: %d', $width));
            }

            $this->width = intval($width);
        } else {
            $this->width = null;
        }

        return $this;
    }

    /**
     * Returns width.
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Sets height.
     *
     * @param integer $height
     *
     * @return FeedImage
     *
     * @throws \InvalidArgumentException
     */
    public function setHeight($height)
    {
        if (!is_null($height)) {
            if (intval($height) < 0) {
                throw new \InvalidArgumentException(sprintf('Invalid height: %d', $height));
            }

            $this->height = $height;
        } else {
            $this->height = null;
        }

        return $this;
    }

    /**
     * Returns height.
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets description.
     *
     * @param string $description
     *
     * @return FeedImage
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Returns description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
