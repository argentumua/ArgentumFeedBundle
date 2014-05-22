<?php

namespace Argentum\FeedBundle\Feed;

/**
 * FeedCloud
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedCloud
{
    protected $domain;

    protected $port;

    protected $path;

    protected $registerProcedure;

    protected $protocol;

    /**
     * Constructor.
     *
     * @param string $domain
     * @param integer $port
     * @param string $path
     * @param string $registerProcedure
     * @param string $protocol
     */
    public function __construct($domain, $port, $path, $registerProcedure, $protocol)
    {
        $this->setDomain($domain);
        $this->setPort($port);
        $this->setPath($path);
        $this->setRegisterProcedure($registerProcedure);
        $this->setProtocol($protocol);
    }

    /**
     * Creates an instance initialized with given values.
     *
     * @param array $values
     *
     * @return FeedCloud
     */
    public static function createFromArray(array $values)
    {
        $cloud = new self(
            $values['domain'],
            $values['port'],
            $values['path'],
            $values['registerProcedure'],
            $values['protocol']
        );

        return $cloud;
    }

    /**
     * Sets domain.
     *
     * @param string $domain
     *
     * @return FeedCloud
     *
     * @throws \InvalidArgumentException
     */
    public function setDomain($domain)
    {
        if (strlen($domain) == 0) {
            throw new \InvalidArgumentException(sprintf('Cloud domain should not be empty'));
        }

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

    /**
     * Sets port.
     *
     * @param integer $port
     *
     * @return FeedCloud
     *
     * @throws \InvalidArgumentException
     */
    public function setPort($port)
    {
        if (intval($port) <= 0) {
            throw new \InvalidArgumentException(sprintf('Invalid port: %d', $port));
        }

        $this->port = intval($port);

        return $this;
    }

    /**
     * Returns port.
     *
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Sets path.
     *
     * @param string $path
     *
     * @return FeedCloud
     *
     * @throws \InvalidArgumentException
     */
    public function setPath($path)
    {
        if (strlen($path) == 0) {
            throw new \InvalidArgumentException(sprintf('Cloud path should not be empty'));
        }

        $this->path = $path;

        return $this;
    }

    /**
     * Returns path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets registerProcedure.
     *
     * @param string $registerProcedure
     *
     * @return FeedCloud
     *
     * @throws \InvalidArgumentException
     */
    public function setRegisterProcedure($registerProcedure)
    {
        if (strlen($registerProcedure) == 0) {
            throw new \InvalidArgumentException(sprintf('Cloud registerProcedure should not be empty'));
        }

        $this->registerProcedure = $registerProcedure;

        return $this;
    }

    /**
     * Returns registerProcedure.
     *
     * @return string
     */
    public function getRegisterProcedure()
    {
        return $this->registerProcedure;
    }

    /**
     * Sets protocol.
     *
     * @param string $protocol
     *
     * @return FeedCloud
     *
     * @throws \InvalidArgumentException
     */
    public function setProtocol($protocol)
    {
        if (strlen($protocol) == 0) {
            throw new \InvalidArgumentException(sprintf('Cloud protocol should not be empty'));
        }

        $this->protocol = $protocol;

        return $this;
    }

    /**
     * Returns protocol.
     *
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }
}
