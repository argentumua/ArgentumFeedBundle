<?php

namespace Argentum\FeedBundle\Feed;

/**
 * FeedItem
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedItem
{
    protected $title;

    protected $link;

    protected $description;

    protected $author;

    protected $categories;

    protected $comments;

    protected $enclosures;

    protected $guid;

    protected $pubDate;

    protected $source;

    protected $customValues;

    protected $routeName;

    protected $routeParameters;

    use FeedRouteTrait;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->categories   = array();
        $this->enclosures   = array();
        $this->customValues = array();
    }

    /**
     * Sets title.
     *
     * @param string $title
     *
     * @return FeedItem
     *
     * @throws \InvalidArgumentException
     */
    public function setTitle($title)
    {
        if (strlen($title) == 0) {
            throw new \InvalidArgumentException(sprintf('Item title should not be empty'));
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
     * @return FeedItem
     */
    public function setLink($link)
    {
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
     * Sets description.
     *
     * @param string $description
     *
     * @return FeedItem
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

    /**
     * Sets author.
     *
     * @param FeedItemAuthor $author
     *
     * @return FeedItem
     */
    public function setAuthor(FeedItemAuthor $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Returns author.
     *
     * @return FeedItemAuthor
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Sets categories.
     *
     * @param FeedItemCategory[] $categories
     *
     * @return FeedItem
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Returns categories.
     *
     * @return FeedItemCategory[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Adds category.
     *
     * @param FeedItemCategory $category
     *
     * @return FeedItem
     */
    public function addCategory(FeedItemCategory $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Sets comments.
     *
     * @param string $comments
     *
     * @return FeedItem
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Returns comments.
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Sets enclosures.
     *
     * @param FeedItemEnclosure[] $enclosures
     *
     * @return FeedItem
     */
    public function setEnclosures($enclosures)
    {
        $this->enclosures = array();

        foreach ($enclosures as $enclosure) {
            $this->addEnclosure($enclosure);
        }

        return $this;
    }

    /**
     * Returns enclosures.
     *
     * @return FeedItemEnclosure[]
     */
    public function getEnclosures()
    {
        return $this->enclosures;
    }

    /**
     * Add enclosure.
     *
     * @param FeedItemEnclosure $enclosure
     *
     * @return FeedItem
     */
    public function addEnclosure(FeedItemEnclosure $enclosure)
    {
        $this->enclosures[] = $enclosure;

        return $this;
    }

    /**
     * Sets guid.
     *
     * @param FeedItemGuid $guid
     *
     * @return FeedItem
     */
    public function setGuid(FeedItemGuid $guid = null)
    {
        $this->guid = $guid;

        return $this;
    }

    /**
     * Returns guid.
     *
     * @return FeedItemGuid
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * Sets pubDate.
     *
     * @param \DateTime $pubDate
     *
     * @return FeedItem
     */
    public function setPubDate(\DateTime $pubDate = null)
    {
        $this->pubDate = $pubDate;

        return $this;
    }

    /**
     * Returns pubDate.
     *
     * @return \DateTime
     */
    public function getPubDate()
    {
        return $this->pubDate;
    }

    /**
     * Sets source.
     *
     * @param FeedItemSource $source
     *
     * @return FeedItem
     */
    public function setSource(FeedItemSource $source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Returns source.
     *
     * @return FeedItemSource
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Sets custom values.
     *
     * @param array $customValues
     *
     * @return FeedItem
     *
     * @throws \InvalidArgumentException
     */
    public function setCustomValues($customValues)
    {
        if (!is_array($customValues) && !($customValues instanceof \Traversable)) {
            throw new \InvalidArgumentException('You should pass an array or a collection of key-value pairs');
        }

        $this->customValues = array();

        foreach ($customValues as $element => $value) {
            $this->addCustomValue($element, $value);
        }

        return $this;
    }

    /**
     * Returns custom values.
     *
     * @return array
     */
    public function getCustomValues()
    {
        return $this->customValues;
    }

    /**
     * Adds custom element value.
     *
     * @param string $element
     * @param string $value
     *
     * @return FeedItem
     */
    public function addCustomValue($element, $value)
    {
        $this->customValues[$element] = $value;

        return $this;
    }
}
