<?php

namespace Argentum\FeedBundle\Feed;

/**
 * FeedTextInput
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedTextInput
{
    protected $title;

    protected $description;

    protected $name;

    protected $link;

    /**
     * Constructor.
     *
     * @param string $title
     * @param string $description
     * @param string $name
     * @param string $link
     */
    public function __construct($title, $description, $name, $link)
    {
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setName($name);
        $this->setLink($link);
    }

    /**
     * Creates an instance initialized with given values.
     *
     * @param array $values
     *
     * @return FeedTextInput
     */
    public static function createFromArray(array $values)
    {
        $textInput = new self(
            $values['title'],
            $values['description'],
            $values['name'],
            $values['link']
        );

        return $textInput;
    }

    /**
     * Sets title.
     *
     * @param string $title
     *
     * @return FeedTextInput
     *
     * @throws \InvalidArgumentException
     */
    public function setTitle($title)
    {
        if (strlen($title) == 0) {
            throw new \InvalidArgumentException(sprintf('TextInput title should not be empty'));
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
     * Sets description.
     *
     * @param string $description
     *
     * @return FeedTextInput
     *
     * @throws \InvalidArgumentException
     */
    public function setDescription($description)
    {
        if (strlen($description) == 0) {
            throw new \InvalidArgumentException(sprintf('TextInput description should not be empty'));
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
     * Sets name.
     *
     * @param string $name
     *
     * @return FeedTextInput
     *
     * @throws \InvalidArgumentException
     */
    public function setName($name)
    {
        if (strlen($name) == 0) {
            throw new \InvalidArgumentException(sprintf('TextInput name should not be empty'));
        }

        $this->name = $name;

        return $this;
    }

    /**
     * Returns name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets link.
     *
     * @param string $link
     *
     * @return FeedTextInput
     *
     * @throws \InvalidArgumentException
     */
    public function setLink($link)
    {
        if (strlen($link) == 0) {
            throw new \InvalidArgumentException(sprintf('TextInput link should not be empty'));
        }

        if (!preg_match('@^https?://@', $link)) {
            throw new \InvalidArgumentException(sprintf('Invalid url: %s', $link));
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
}
