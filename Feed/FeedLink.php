<?php
/**
 * Copyright (c) 2018.
 */

namespace Argentum\FeedBundle\Feed;

/**
 * FeedLink
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedLink
{
    protected $routeName;

    protected $routeParameters;

    /**
     * Constructor.
     *
     * @param string $name
     * @param array  $parameters
     */
    public function __construct($name, array $parameters = [])
    {
        $this->setRouteName($name);
        $this->setRouteParameters($parameters);
    }

    /**
     * Creates an instance initialized with given values.
     *
     * @param array $values
     *
     * @return FeedLink
     */
    public static function createFromArray(array $values)
    {
        $link = new self($values['name'], isset($values['parameters']) ? $values['parameters'] : []);

        return $link;
    }

    /**
     * Sets routeName.
     *
     * @param string $routeName
     * @param array  $routeParameters
     *
     * @return FeedLink
     */
    public function setRoute($routeName, array $routeParameters = [])
    {
        $this->setRouteName($routeName);
        $this->setRouteParameters($routeParameters);

        return $this;
    }

    /**
     * Sets link.
     *
     * @param string $routeName
     *
     * @return FeedLink
     *
     * @throws \InvalidArgumentException
     */
    public function setRouteName($routeName)
    {
        if (strlen($routeName) == 0) {
            throw new \InvalidArgumentException(sprintf('Route name should not be empty'));
        }

        $this->routeName = $routeName;

        return $this;
    }

    /**
     * Returns link.
     *
     * @return string
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * @return array
     */
    public function getRouteParameters()
    {
        return $this->routeParameters;
    }

    /**
     * @param array $routeParameters
     *
     * @return $this
     */
    public function setRouteParameters(array $routeParameters = [])
    {
        $this->routeParameters = $routeParameters;

        return $this;
    }


}
