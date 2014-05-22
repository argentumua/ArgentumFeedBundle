<?php

namespace Argentum\FeedBundle\Tests\Feed;

use Argentum\FeedBundle\Feed\FeedCloud;

/**
 * FeedCloudTest
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedCloudTest extends \PHPUnit_Framework_TestCase
{
    const CLASS_NAME = 'Argentum\FeedBundle\Feed\FeedCloud';

    /**
     * @var FeedCloud
     */
    private $cloud;

    protected function setUp()
    {
        $this->cloud = new FeedCloud('domain', 80, '/xmlrpc', 'register', 'xmlrpc');
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(self::CLASS_NAME, $this->cloud);
        $this->assertEquals('domain', $this->cloud->getDomain());
        $this->assertEquals(80, $this->cloud->getPort());
        $this->assertEquals('/xmlrpc', $this->cloud->getPath());
        $this->assertEquals('register', $this->cloud->getRegisterProcedure());
        $this->assertEquals('xmlrpc', $this->cloud->getProtocol());
    }

    public function testCreateFromArray()
    {
        $cloudArray = array(
            'domain' => 'domain',
            'port' => 80,
            'path' => '/xmlrpc',
            'registerProcedure' => 'register',
            'protocol' => 'xmlrpc',
        );

        $cloud = FeedCloud::createFromArray($cloudArray);
        $this->assertInstanceOf(self::CLASS_NAME, $this->cloud);
        $this->assertEquals($cloudArray['domain'], $cloud->getDomain());
        $this->assertEquals($cloudArray['port'], $cloud->getPort());
        $this->assertEquals($cloudArray['path'], $cloud->getPath());
        $this->assertEquals($cloudArray['registerProcedure'], $cloud->getRegisterProcedure());
        $this->assertEquals($cloudArray['protocol'], $cloud->getProtocol());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDomainNull()
    {
        $this->cloud->setDomain(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testPortNull()
    {
        $this->cloud->setPort(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testPortNegative()
    {
        $this->cloud->setPort(-1);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testPathNull()
    {
        $this->cloud->setPath(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRegisterProcedureNull()
    {
        $this->cloud->setRegisterProcedure(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testProtocolNull()
    {
        $this->cloud->setProtocol(null);
    }
}
