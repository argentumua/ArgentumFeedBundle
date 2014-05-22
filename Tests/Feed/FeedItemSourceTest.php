<?php

namespace Argentum\FeedBundle\Tests\Feed;

use Argentum\FeedBundle\Feed\FeedItemSource;

/**
 * FeedItemSourceTest
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedItemSourceTest extends \PHPUnit_Framework_TestCase
{
    const CLASS_NAME = 'Argentum\FeedBundle\Feed\FeedItemSource';

    /**
     * @var FeedItemSource
     */
    private $source;

    protected function setUp()
    {
        $this->source = new FeedItemSource('title', 'http://example.com');
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(self::CLASS_NAME, $this->source);
        $this->assertEquals('title', $this->source->getTitle());
        $this->assertEquals('http://example.com', $this->source->getUrl());
    }

    public function testTitle()
    {
        $this->source->setTitle('source');
        $this->assertEquals('source', $this->source->getTitle());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTitleNull()
    {
        $this->source->setTitle(null);
    }

    public function testUrl()
    {
        $this->source->setUrl('http://example.com/source');
        $this->assertEquals('http://example.com/source', $this->source->getUrl());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUrlIncorrect()
    {
        $this->source->setUrl('some text');
    }

    public function testUrlNull()
    {
        $this->source->setUrl(null);
        $this->assertEquals(null, $this->source->getUrl());
    }
}
