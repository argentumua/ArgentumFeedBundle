<?php
/**
 * Copyright (c) 2018.
 */

namespace Argentum\FeedBundle\Feed;

/**
 * FeedRouteTrait
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
trait FeedRouteTrait
{
    protected $routeName;

    protected $routeParameters;


    /**
     * Sets routeName.
     *
     * @param string $routeName
     * @param array  $routeParameters
     *
     * @return $this
     */
    public function setRoute($routeName, array $routeParameters = [])
    {
        $this->setRouteName($routeName);
        $this->setRouteParameters($routeParameters);

        return $this;
    }

    /**
     * @param string $routeName
     *
     * @throws \InvalidArgumentException
     * @return $this
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
