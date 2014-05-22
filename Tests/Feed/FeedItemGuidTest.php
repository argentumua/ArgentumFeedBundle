<?php

namespace Argentum\FeedBundle\Tests\Feed;

use Argentum\FeedBundle\Feed\FeedItemGuid;

/**
 * FeedItemGuidTest
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedItemGuidTest extends \PHPUnit_Framework_TestCase
{
    const CLASS_NAME = 'Argentum\FeedBundle\Feed\FeedItemGuid';

    /**
     * @var FeedItemGuid
     */
    private $guid;

    protected function setUp()
    {
        $this->guid = new FeedItemGuid('http://example.com/article', true);
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(self::CLASS_NAME, $this->guid);
        $this->assertEquals('http://example.com/article', $this->guid->getLink());
        $this->assertTrue($this->guid->getIsPermaLink());
    }

    public function testLink()
    {
        $this->guid->setLink('http://example.com/item');
        $this->assertEquals('http://example.com/item', $this->guid->getLink());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testLinkNull()
    {
        $this->guid->setLink(null);
    }

    public function testIsPermaLink()
    {
        $this->guid->setIsPermaLink(false);
        $this->assertFalse($this->guid->getIsPermaLink());
    }
}
