<?php
/**
 * Copyright (c) 2018.
 */

namespace Argentum\FeedBundle\Feed;

/**
 * FeedItemAuthor
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedItemAuthor
{
    protected $email;

    protected $name;

    /**
     * Constructor.
     *
     * @param string $email
     * @param string $name
     */
    public function __construct($email, $name = null)
    {
        $this->setEmail($email);
        $this->setName($name);
    }

    /**
     * Sets link.
     *
     * @param string $email
     *
     * @return FeedItemAuthor
     *
     * @throws \InvalidArgumentException
     */
    public function setEmail($email)
    {
        if (strlen($email) == 0) {
            throw new \InvalidArgumentException(sprintf('Email should not be empty'));
        }

        $this->email = $email;

        return $this;
    }

    /**
     * Returns link.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->name ? sprintf('%s (%s)', $this->email, $this->name) : $this->email;
    }
}
