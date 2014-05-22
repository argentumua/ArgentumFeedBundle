<?php

namespace Argentum\FeedBundle\Feed;

/**
 * FeedItemCategory
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedItemCategory
{
    protected $title;

    protected $domain;

    /**
     * Constructor.
     *
     * @param string $title
     * @param string $domain
     */
    public function __construct($title, $domain = null)
    {
        $this->setTitle($title);
        $this->setDomain($domain);
    }

    /**
     * Creates an instance initialized with given values.
     *
     * @param array $values
     *
     * @return FeedItemCategory
     */
    public static function createFromArray(array $values)
    {
        $category = new self($values['title'], isset($values['domain']) ? $values['domain'] : null);

        return $category;
    }

    /**
     * Sets title.
     *
     * @param string $title
     *
     * @return FeedItemCategory
     *
     * @throws \InvalidArgumentException
     */
    public function setTitle($title)
    {
        if (strlen($title) == 0) {
            throw new \InvalidArgumentException(sprintf('Category title should not be empty'));
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
     * Sets domain.
     *
     * @param string $domain
     *
     * @return FeedItemCategory
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Returns domain.
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }
}
