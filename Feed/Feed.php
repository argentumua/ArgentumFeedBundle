<?php

namespace Argentum\FeedBundle\Feed;

use Argentum\FeedBundle\Renderer\RendererInterface;

/**
 * Feed
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class Feed implements FeedInterface
{
    protected $title;

    protected $link;

    protected $description;

    protected $language;

    protected $copyright;

    protected $managingEditor;

    protected $webMaster;

    protected $pubDate;

    protected $lastBuildDate;

    protected $categories;

    protected $generator;

    protected $docs;

    protected $cloud;

    protected $ttl;

    protected $image;

    protected $rating;

    protected $textInput;

    protected $skipHours;

    protected $skipDays;

    protected $namespaces;

    protected $customElements;

    protected $encoding;

    protected $translationDomain;

    protected $channel;

    protected $items;

    protected $renderer;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->encoding = 'utf-8';
        $this->categories = array();
        $this->items = array();
        $this->namespaces = array();
        $this->customElements = array();
    }

    /**
     * Sets title.
     *
     * @param string $title
     *
     * @return Feed
     *
     * @throws \InvalidArgumentException
     */
    public function setTitle($title)
    {
        if (strlen($title) == 0) {
            throw new \InvalidArgumentException(sprintf('Channel title should not be empty'));
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
     * @return Feed
     *
     * @throws \InvalidArgumentException
     */
    public function setLink($link)
    {
        if (strlen($link) == 0) {
            throw new \InvalidArgumentException(sprintf('Channel link should not be empty'));
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
     * Sets description.
     *
     * @param string $description
     *
     * @return Feed
     *
     * @throws \InvalidArgumentException
     */
    public function setDescription($description)
    {
        if (strlen($description) == 0) {
            throw new \InvalidArgumentException(sprintf('Channel description should not be empty'));
        }

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
     * Sets language.
     *
     * @param string $language
     *
     * @return Feed
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Returns language.
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets copyright.
     *
     * @param string $copyright
     *
     * @return Feed
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Returns copyright.
     *
     * @return string
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Sets managingEditor.
     *
     * @param string $managingEditor
     *
     * @return Feed
     */
    public function setManagingEditor($managingEditor)
    {
        $this->managingEditor = $managingEditor;

        return $this;
    }

    /**
     * Returns managingEditor.
     *
     * @return string
     */
    public function getManagingEditor()
    {
        return $this->managingEditor;
    }

    /**
     * Sets webMaster.
     *
     * @param string $webMaster
     *
     * @return Feed
     */
    public function setWebMaster($webMaster)
    {
        $this->webMaster = $webMaster;

        return $this;
    }

    /**
     * Returns webMaster.
     *
     * @return string
     */
    public function getWebMaster()
    {
        return $this->webMaster;
    }

    /**
     * Sets pubDate.
     *
     * @param \DateTime|string $pubDate
     *
     * @return Feed
     */
    public function setPubDate($pubDate)
    {
        if ($pubDate instanceof \DateTime) {
            $this->pubDate = $pubDate;
        } else {
            $this->pubDate = new \DateTime($pubDate);
        }

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
     * Sets lastBuildDate.
     *
     * @param \DateTime|string $lastBuildDate
     *
     * @return Feed
     */
    public function setLastBuildDate($lastBuildDate)
    {
        if ($lastBuildDate instanceof \DateTime) {
            $this->lastBuildDate = $lastBuildDate;
        } else {
            $this->lastBuildDate = new \DateTime($lastBuildDate);
        }

        return $this;
    }

    /**
     * Returns lastBuildDate.
     *
     * @return \DateTime
     */
    public function getLastBuildDate()
    {
        return $this->lastBuildDate;
    }

    /**
     * Sets categories.
     *
     * @param FeedItemCategory[] $categories
     *
     * @return Feed
     */
    public function setCategories($categories)
    {
        $this->categories = array();

        foreach ($categories as $category) {
            $this->addCategory($category);
        }

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
     * @param FeedItemCategory|array $category
     *
     * @return Feed
     *
     * @throws \InvalidArgumentException
     */
    public function addCategory($category)
    {
        if ($category instanceof FeedItemCategory) {
            $this->categories[] = $category;
        } elseif (is_array($category)) {
            if (!empty($category)) {
                $this->categories[] = FeedItemCategory::createFromArray($category);
            }
        } else {
            throw new \InvalidArgumentException('Invalid category');
        }

        return $this;
    }

    /**
     * Sets generator.
     *
     * @param string $generator
     *
     * @return Feed
     */
    public function setGenerator($generator)
    {
        $this->generator = $generator;

        return $this;
    }

    /**
     * Returns generator.
     *
     * @return string
     */
    public function getGenerator()
    {
        return $this->generator;
    }

    /**
     * Sets docs.
     *
     * @param string $docs
     *
     * @return Feed
     */
    public function setDocs($docs)
    {
        $this->docs = $docs;

        return $this;
    }

    /**
     * Returns docs.
     *
     * @return string
     */
    public function getDocs()
    {
        return $this->docs;
    }

    /**
     * Sets cloud.
     *
     * @param FeedCloud|array $cloud
     *
     * @return Feed
     *
     * @throws \InvalidArgumentException
     */
    public function setCloud($cloud)
    {
        if ($cloud instanceof FeedCloud) {
            $this->cloud = $cloud;
        } elseif (is_array($cloud)) {
            if (!empty($cloud)) {
                $this->cloud = FeedCloud::createFromArray($cloud);
            }
        } elseif (is_null($cloud)) {
            $this->cloud = null;
        } else {
            throw new \InvalidArgumentException('Invalid cloud');
        }

        return $this;
    }

    /**
     * Returns cloud.
     *
     * @return FeedCloud
     */
    public function getCloud()
    {
        return $this->cloud;
    }

    /**
     * Sets ttl.
     *
     * @param integer $ttl
     *
     * @return Feed
     *
     * @throws \InvalidArgumentException
     */
    public function setTtl($ttl)
    {
        if (!is_null($ttl)) {
            if (!is_numeric($ttl) || (intval($ttl) < 1)) {
                throw new \InvalidArgumentException(sprintf('Invalid TTL: %s', $ttl));
            }

            $this->ttl = intval($ttl);
        } else {
            $this->ttl = null;
        }

        return $this;
    }

    /**
     * Returns ttl.
     *
     * @return integer
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * Sets image.
     *
     * @param FeedImage|array $image
     *
     * @return Feed
     *
     * @throws \InvalidArgumentException
     */
    public function setImage($image)
    {
        if ($image instanceof FeedImage) {
            $this->image = $image;
        } elseif (is_array($image)) {
            if (!empty($image)) {
                $this->image = FeedImage::createFromArray($image);
            }
        } elseif (is_null($image)) {
            $this->image = null;
        } else {
            throw new \InvalidArgumentException('Invalid image');
        }

        return $this;
    }

    /**
     * Returns image.
     *
     * @return FeedImage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets rating.
     *
     * @param string $rating
     *
     * @return Feed
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Returns rating.
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Sets textInput.
     *
     * @param FeedTextInput|array $textInput
     *
     * @return Feed
     *
     * @throws \InvalidArgumentException
     */
    public function setTextInput($textInput)
    {
        if ($textInput instanceof FeedTextInput) {
            $this->textInput = $textInput;
        } elseif (is_array($textInput)) {
            if (!empty($textInput)) {
                $this->textInput = FeedTextInput::createFromArray($textInput);
            }
        } elseif (is_null($textInput)) {
            $this->textInput = null;
        } else {
            throw new \InvalidArgumentException('Invalid textInput');
        }

        return $this;
    }

    /**
     * Returns textInput.
     *
     * @return FeedTextInput
     */
    public function getTextInput()
    {
        return $this->textInput;
    }

    /**
     * Sets skipHours.
     *
     * @param array $skipHours
     *
     * @return Feed
     */
    public function setSkipHours(array $skipHours)
    {
        $skipHours = array_filter($skipHours, function ($hour) {
            return is_numeric($hour) && ($hour >= 0) && ($hour <= 23);
        });

        $skipHours = array_unique($skipHours);
        sort($skipHours);

        $this->skipHours = array_values($skipHours);

        return $this;
    }

    /**
     * Returns skipHours.
     *
     * @return array
     */
    public function getSkipHours()
    {
        return $this->skipHours;
    }

    /**
     * Sets skipDays.
     *
     * @param array $skipDays
     *
     * @return Feed
     */
    public function setSkipDays(array $skipDays)
    {
        $skipDays = array_unique(array_filter($skipDays));
        $this->skipDays = array_values($skipDays);

        return $this;
    }

    /**
     * Returns skipDays.
     *
     * @return array
     */
    public function getSkipDays()
    {
        return $this->skipDays;
    }

    /**
     * Sets namespaces.
     *
     * @param array $namespaces
     *
     * @return Feed
     */
    public function setNamespaces(array $namespaces)
    {
        $this->namespaces = array();

        foreach ($namespaces as $prefix => $uri) {
            $this->addNamespace($uri, $prefix);
        }

        return $this;
    }

    /**
     * Returns namespaces.
     *
     * @return array
     */
    public function getNamespaces()
    {
        return $this->namespaces;
    }

    /**
     * Adds namespace.
     *
     * @param string $uri
     * @param string $prefix
     *
     * @return Feed
     *
     * @throws \InvalidArgumentException
     */
    public function addNamespace($uri, $prefix = 'default')
    {
        if (strlen($uri) == 0) {
            throw new \InvalidArgumentException(sprintf('Namespace URI should not be empty'));
        }

        $this->namespaces[$prefix] = $uri;

        return $this;
    }

    /**
     * Checks whether the namespace is registered.
     *
     * @param string $prefix
     *
     * @return boolean
     */
    public function hasNamespace($prefix)
    {
        return array_key_exists($prefix, $this->getNamespaces());
    }

    /**
     * Sets custom item elements.
     *
     * @param string[] $customElements
     *
     * @return Feed
     */
    public function setCustomElements(array $customElements)
    {
        $this->customElements = array();

        foreach ($customElements as $element) {
            $this->addCustomElement($element);
        }

        return $this;
    }

    /**
     * Returns custom item elements.
     *
     * @return string[]
     */
    public function getCustomElements()
    {
        return $this->customElements;
    }

    /**
     * Adds custom item element.
     *
     * @param string $element
     *
     * @return Feed
     *
     * @throws \InvalidArgumentException
     */
    public function addCustomElement($element)
    {
        if (($colon = strpos($element, ':')) !== false) {
            $namespace = substr($element, 0, $colon);
            if (!$this->hasNamespace($namespace)) {
                throw new \InvalidArgumentException(sprintf('Unregistered namespace: %s', $namespace));
            }
        }

        $this->customElements[] = $element;

        return $this;
    }

    /**
     * Sets encoding.
     *
     * @param string $encoding
     *
     * @return Feed
     *
     * @throws \InvalidArgumentException
     */
    public function setEncoding($encoding)
    {
        if (strlen($encoding) == 0) {
            throw new \InvalidArgumentException(sprintf('Encoding should not be empty'));
        }

        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Returns encoding.
     *
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Sets translationDomain.
     *
     * @param string $translationDomain
     *
     * @return Feed
     */
    public function setTranslationDomain($translationDomain = null)
    {
        if (!$translationDomain) {
            $translationDomain = 'messages';
        }

        $this->translationDomain = $translationDomain;

        return $this;
    }

    /**
     * Returns translationDomain.
     *
     * @return string
     */
    public function getTranslationDomain()
    {
        return $this->translationDomain;
    }

    /**
     * Sets channel elements.
     *
     * May contain any custom elements.
     *
     * @param array $channel
     *
     * @return Feed
     */
    public function setChannel(array $channel)
    {
        foreach ($channel as $element => $value) {
            $setter = 'set' . ucfirst($element);

            if (method_exists($this, $setter)) {
                $this->$setter($value);
                unset($channel[$element]);
            }
        }

        $this->channel = $channel;

        return $this;
    }

    /**
     * Returns channel custom elements.
     *
     * @return array
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Sets items.
     *
     * @param FeedItem[] $items
     *
     * @return Feed
     */
    public function setItems($items)
    {
        $this->items = array();

        foreach ($items as $item) {
            $this->addItem($item);
        }

        return $this;
    }

    /**
     * Returns items.
     *
     * @return FeedItem[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Adds item.
     *
     * @param FeedItem $item
     *
     * @return Feed
     */
    public function addItem(FeedItem $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Adds feedable items.
     *
     * @param Feedable[] $items A collection of feedable items
     *
     * @return Feed
     *
     * @throws \InvalidArgumentException
     */
    public function addFeedableItems($items)
    {
        if (!is_array($items) && !($items instanceof \Traversable)) {
            throw new \InvalidArgumentException('You should pass an array or a collection of Feedable items');
        }

        foreach ($items as $feedable) {
            if (!$feedable instanceof Feedable) {
                throw new \InvalidArgumentException('Feedable items should implement Feedable interface');
            }

            $this->addItem($feedable->getFeedItem());
        }

        return $this;
    }

    /**
     * Sets renderer.
     *
     * @param RendererInterface $renderer
     *
     * @return Feed
     */
    public function setRenderer(RendererInterface $renderer)
    {
        $this->renderer = $renderer;

        return $this;
    }

    /**
     * Returns renderer.
     *
     * @return RendererInterface
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * Renders the feed and returns a string representation.
     *
     * @return string
     */
    public function render()
    {
        return $this->getRenderer()->render($this);
    }
}
