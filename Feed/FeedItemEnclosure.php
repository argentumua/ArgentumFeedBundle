<?php

namespace Argentum\FeedBundle\Feed;

/**
 * FeedItemEnclosure
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedItemEnclosure
{
    protected $url;

    protected $length;

    protected $type;

    /**
     * Constructor.
     *
     * @param string $url
     * @param string $type
     * @param integer $length
     */
    public function __construct($url, $type, $length = 0)
    {
        $this->setUrl($url);
        $this->setType($type);
        $this->setLength($length);
    }

    /**
     * Creates an instance initialized with given values.
     *
     * @param array $values
     *
     * @return FeedItemEnclosure
     */
    public static function createFromArray(array $values)
    {
        $category = new self($values['url'], $values['type'], isset($values['length']) ? $values['length'] : 0);

        return $category;
    }

    /**
     * Sets url.
     *
     * @param string $url
     *
     * @return FeedItemEnclosure
     *
     * @throws \InvalidArgumentException
     */
    public function setUrl($url)
    {
        if (strlen($url) == 0) {
            throw new \InvalidArgumentException(sprintf('Enclosure URL should not be empty'));
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
     * Sets length.
     *
     * @param integer $length
     *
     * @return FeedItemEnclosure
     *
     * @throws \LengthException
     */
    public function setLength($length)
    {
        if (intval($length) < 0) {
            throw new \LengthException(sprintf('Invalid length: %d', $length));
        }

        $this->length = intval($length);

        return $this;
    }

    /**
     * Returns length.
     *
     * @return integer
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Sets type.
     *
     * @param string $type
     *
     * @return FeedItemEnclosure
     *
     * @throws \InvalidArgumentException
     */
    public function setType($type)
    {
        if (strlen($type) == 0) {
            throw new \InvalidArgumentException(sprintf('MIME type should not be empty'));
        }

        if (!preg_match('@^[^/]+/[^/]+$@', $type)) {
            throw new \InvalidArgumentException(sprintf('Invalid MIME type: %s', $type));
        }

        $this->type = $type;

        return $this;
    }

    /**
     * Returns type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
