<?php

namespace Argentum\FeedBundle\Tests\Feed;

use Argentum\FeedBundle\Feed\FeedImage;

/**
 * FeedImageTest
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedImageTest extends \PHPUnit_Framework_TestCase
{
    const CLASS_NAME = 'Argentum\FeedBundle\Feed\FeedImage';

    /**
     * @var FeedImage
     */
    private $image;

    protected function setUp()
    {
        $this->image = new FeedImage('http://example.com/logo.png', 'title', 'http://example.com');
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(self::CLASS_NAME, $this->image);
        $this->assertEquals('http://example.com/logo.png', $this->image->getUrl());
        $this->assertEquals('title', $this->image->getTitle());
        $this->assertEquals('http://example.com', $this->image->getLink());
    }

    public function testCreateFromArray()
    {
        $imageArray = array(
            'url' => 'http://example.com/logo.png',
            'title' => 'title',
            'link' => 'http://example.com',
            'width' => '128',
            'height' => '96',
            'description' => 'description',
        );

        $image = FeedImage::createFromArray($imageArray);
        $this->assertInstanceOf(self::CLASS_NAME, $this->image);
        $this->assertEquals($imageArray['url'], $image->getUrl());
        $this->assertEquals($imageArray['title'], $image->getTitle());
        $this->assertEquals($imageArray['link'], $image->getLink());
        $this->assertEquals($imageArray['width'], $image->getWidth());
        $this->assertEquals($imageArray['height'], $image->getHeight());
        $this->assertEquals($imageArray['description'], $image->getDescription());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUrlNull()
    {
        $this->image->setUrl(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTitleNull()
    {
        $this->image->setTitle(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testLinkNull()
    {
        $this->image->setLink(null);
    }

    public function testWidthNull()
    {
        $this->image->setWidth(null);
        $this->assertEquals(null, $this->image->getWidth());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWidthNegative()
    {
        $this->image->setWidth(-1);
    }

    public function testHeightNull()
    {
        $this->image->setHeight(null);
        $this->assertEquals(null, $this->image->getHeight());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testHeightNegative()
    {
        $this->image->setHeight(-1);
    }

    public function testDescriptionNull()
    {
        $this->image->setDescription(null);
        $this->assertEquals(null, $this->image->getDescription());
    }
}
