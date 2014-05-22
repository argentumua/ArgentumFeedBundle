<?php

namespace Argentum\FeedBundle\Tests\Feed;

use Argentum\FeedBundle\Feed\FeedItemEnclosure;

/**
 * FeedItemEnclosureTest
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedItemEnclosureTest extends \PHPUnit_Framework_TestCase
{
    const CLASS_NAME = 'Argentum\FeedBundle\Feed\FeedItemEnclosure';

    /**
     * @var FeedItemEnclosure
     */
    private $enclosure;

    protected function setUp()
    {
        $this->enclosure = new FeedItemEnclosure('http://example.com/logo.png', 'image/png', 12345);
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(self::CLASS_NAME, $this->enclosure);
        $this->assertEquals('http://example.com/logo.png', $this->enclosure->getUrl());
        $this->assertEquals('image/png', $this->enclosure->getType());
        $this->assertEquals(12345, $this->enclosure->getLength());
    }

    public function testCreateFromArray()
    {
        $enclosureArray = array(
            'url' => 'http://example.com/logo.png',
            'type' => 'image/png',
            'length' => 12345,
        );

        $enclosure = FeedItemEnclosure::createFromArray($enclosureArray);
        $this->assertInstanceOf(self::CLASS_NAME, $this->enclosure);
        $this->assertEquals($enclosureArray['url'], $enclosure->getUrl());
        $this->assertEquals($enclosureArray['type'], $enclosure->getType());
        $this->assertEquals($enclosureArray['length'], $enclosure->getLength());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUrlNull()
    {
        $this->enclosure->setUrl(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTypeIncorrect()
    {
        $this->enclosure->setType('12345');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTypeNull()
    {
        $this->enclosure->setType(null);
    }

    /**
     * @expectedException \LengthException
     */
    public function testLengthNegative()
    {
        $this->enclosure->setLength(-1);
    }

    public function testLengthNull()
    {
        $this->enclosure->setLength(null);
        $this->assertEquals(0, $this->enclosure->getLength());
    }
}
