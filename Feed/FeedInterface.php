<?php

namespace Argentum\FeedBundle\Feed;

use Argentum\FeedBundle\Renderer\RendererInterface;

/**
 * FeedInterface
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
interface FeedInterface
{
    /**
     * Sets title.
     *
     * @param string $title
     *
     * @return FeedInterface
     *
     * @throws \InvalidArgumentException
     */
    public function setTitle($title);

    /**
     * Returns title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Sets link.
     *
     * @param string $link
     *
     * @return FeedInterface
     *
     * @throws \InvalidArgumentException
     */
    public function setLink($link);

    /**
     * Returns link.
     *
     * @return string
     */
    public function getLink();

    /**
     * Sets description.
     *
     * @param string $description
     *
     * @return FeedInterface
     *
     * @throws \InvalidArgumentException
     */
    public function setDescription($description);

    /**
     * Returns description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Sets language.
     *
     * @param string $language
     *
     * @return FeedInterface
     */
    public function setLanguage($language);

    /**
     * Returns language.
     *
     * @return string
     */
    public function getLanguage();

    /**
     * Sets copyright.
     *
     * @param string $copyright
     *
     * @return FeedInterface
     */
    public function setCopyright($copyright);

    /**
     * Returns copyright.
     *
     * @return string
     */
    public function getCopyright();

    /**
     * Sets managingEditor.
     *
     * @param string $managingEditor
     *
     * @return FeedInterface
     */
    public function setManagingEditor($managingEditor);

    /**
     * Returns managingEditor.
     *
     * @return string
     */
    public function getManagingEditor();

    /**
     * Sets webMaster.
     *
     * @param string $webMaster
     *
     * @return FeedInterface
     */
    public function setWebMaster($webMaster);

    /**
     * Returns webMaster.
     *
     * @return string
     */
    public function getWebMaster();

    /**
     * Sets pubDate.
     *
     * @param \DateTime|string $pubDate
     *
     * @return FeedInterface
     */
    public function setPubDate($pubDate);

    /**
     * Returns pubDate.
     *
     * @return \DateTime
     */
    public function getPubDate();

    /**
     * Sets lastBuildDate.
     *
     * @param \DateTime|string $lastBuildDate
     *
     * @return FeedInterface
     */
    public function setLastBuildDate($lastBuildDate);

    /**
     * Returns lastBuildDate.
     *
     * @return \DateTime
     */
    public function getLastBuildDate();

    /**
     * Sets categories.
     *
     * @param FeedItemCategory[] $categories
     *
     * @return FeedInterface
     */
    public function setCategories($categories);

    /**
     * Returns categories.
     *
     * @return FeedItemCategory
     */
    public function getCategories();

    /**
     * Adds category.
     *
     * @param FeedItemCategory|array $category
     *
     * @return Feed
     *
     * @throws \InvalidArgumentException
     */
    public function addCategory($category);

    /**
     * Sets generator.
     *
     * @param string $generator
     *
     * @return FeedInterface
     */
    public function setGenerator($generator);

    /**
     * Returns generator.
     *
     * @return string
     */
    public function getGenerator();

    /**
     * Sets docs.
     *
     * @param string $docs
     *
     * @return FeedInterface
     */
    public function setDocs($docs);

    /**
     * Returns docs.
     *
     * @return string
     */
    public function getDocs();

    /**
     * Sets cloud.
     *
     * @param FeedCloud|array $cloud
     *
     * @return FeedInterface
     *
     * @throws \InvalidArgumentException
     */
    public function setCloud($cloud);

    /**
     * Returns cloud.
     *
     * @return FeedCloud
     */
    public function getCloud();

    /**
     * Sets ttl.
     *
     * @param integer $ttl
     *
     * @return FeedInterface
     *
     * @throws \InvalidArgumentException
     */
    public function setTtl($ttl);

    /**
     * Returns ttl.
     *
     * @return integer
     */
    public function getTtl();

    /**
     * Sets image.
     *
     * @param FeedImage|array $image
     *
     * @return FeedInterface
     *
     * @throws \InvalidArgumentException
     */
    public function setImage($image);

    /**
     * Returns image.
     *
     * @return FeedImage
     */
    public function getImage();

    /**
     * Sets rating.
     *
     * @param string $rating
     *
     * @return FeedInterface
     */
    public function setRating($rating);

    /**
     * Returns rating.
     *
     * @return string
     */
    public function getRating();

    /**
     * Sets textInput.
     *
     * @param FeedTextInput|array $textInput
     *
     * @return FeedInterface
     *
     * @throws \InvalidArgumentException
     */
    public function setTextInput($textInput);

    /**
     * Returns textInput.
     *
     * @return FeedTextInput
     */
    public function getTextInput();

    /**
     * Sets skipHours.
     *
     * @param array $skipHours
     *
     * @return FeedInterface
     */
    public function setSkipHours(array $skipHours);

    /**
     * Returns skipHours.
     *
     * @return array
     */
    public function getSkipHours();

    /**
     * Sets skipDays.
     *
     * @param array $skipDays
     *
     * @return FeedInterface
     */
    public function setSkipDays(array $skipDays);

    /**
     * Returns skipDays.
     *
     * @return array
     */
    public function getSkipDays();

    /**
     * Sets namespaces.
     *
     * @param array $namespaces
     *
     * @return FeedInterface
     */
    public function setNamespaces(array $namespaces);

    /**
     * Returns namespaces.
     *
     * @return array
     */
    public function getNamespaces();

    /**
     * Adds namespace.
     *
     * @param string $uri
     * @param string $prefix
     *
     * @return FeedInterface
     */
    public function addNamespace($uri, $prefix = 'default');

    /**
     * Checks whether the namespace is registered.
     *
     * @param string $prefix
     *
     * @return boolean
     */
    public function hasNamespace($prefix);

    /**
     * Sets custom item elements.
     *
     * @param string[] $customElements
     *
     * @return FeedInterface
     */
    public function setCustomElements(array $customElements);

    /**
     * Returns custom item elements.
     *
     * @return string[]
     */
    public function getCustomElements();

    /**
     * Adds custom item element.
     *
     * @param string $element
     *
     * @return FeedInterface
     *
     * @throws \InvalidArgumentException
     */
    public function addCustomElement($element);

    /**
     * Sets encoding.
     *
     * @param string $encoding
     *
     * @return FeedInterface
     *
     * @throws \InvalidArgumentException
     */
    public function setEncoding($encoding);

    /**
     * Returns encoding.
     *
     * @return string
     */
    public function getEncoding();

    /**
     * Sets translationDomain.
     *
     * @param string $translationDomain
     *
     * @return Feed
     */
    public function setTranslationDomain($translationDomain = null);

    /**
     * Returns translationDomain.
     *
     * @return string
     */
    public function getTranslationDomain();

    /**
     * Sets channel elements.
     *
     * May contain any custom elements.
     *
     * @param array $channel
     *
     * @return FeedInterface
     */
    public function setChannel(array $channel);

    /**
     * Returns channel custom elements.
     *
     * @return array
     */
    public function getChannel();

    /**
     * Sets items.
     *
     * @param FeedItem[] $items
     *
     * @return FeedInterface
     */
    public function setItems($items);

    /**
     * Returns items.
     *
     * @return FeedItem[]
     */
    public function getItems();

    /**
     * Adds item.
     *
     * @param FeedItem $item
     *
     * @return FeedInterface
     */
    public function addItem(FeedItem $item);

    /**
     * Adds feedable items.
     *
     * @param Feedable[] $items A collection of feedable items
     *
     * @return Feed
     *
     * @throws \InvalidArgumentException
     */
    public function addFeedableItems($items);

    /**
     * Sets renderer.
     *
     * @param RendererInterface $renderer
     *
     * @return FeedInterface
     */
    public function setRenderer(RendererInterface $renderer);

    /**
     * Returns renderer.
     *
     * @return RendererInterface
     */
    public function getRenderer();

    /**
     * Renders the feed and returns a string representation.
     *
     * @return string
     */
    public function render();
}
