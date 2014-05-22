<?php

namespace Argentum\FeedBundle\Tests\Feed;

use Argentum\FeedBundle\Feed\FeedItem;
use Argentum\FeedBundle\Feed\FeedItemCategory;
use Argentum\FeedBundle\Feed\FeedItemEnclosure;
use Argentum\FeedBundle\Feed\FeedItemGuid;
use Argentum\FeedBundle\Feed\FeedItemSource;

/**
 * FeedItemTest
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedItemTest extends \PHPUnit_Framework_TestCase
{
    const CLASS_NAME = 'Argentum\FeedBundle\Feed\FeedItem';

    public function testConstructor()
    {
        $item = new FeedItem();
        $this->assertInstanceOf(self::CLASS_NAME, $item);
        $this->assertTrue(is_array($item->getCategories()));
        $this->assertEmpty($item->getCategories());
        $this->assertTrue(is_array($item->getEnclosures()));
        $this->assertEmpty($item->getEnclosures());
        $this->assertTrue(is_array($item->getCustomValues()));
        $this->assertEmpty($item->getCustomValues());
    }

    public function testTitle()
    {
        $feed = new FeedItem();
        $result = $feed->setTitle('title');
        $this->assertEquals('title', $feed->getTitle());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTitleEmpty()
    {
        $feed = new FeedItem();
        $feed->setTitle('');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTitleNull()
    {
        $feed = new FeedItem();
        $feed->setTitle(null);
    }

    public function testLink()
    {
        $feed = new FeedItem();
        $result = $feed->setLink('http://example.com');
        $this->assertEquals('http://example.com', $feed->getLink());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testLinkEmptyOrNull()
    {
        $feed = new FeedItem();
        $feed->setLink('');
        $this->assertEquals('', $feed->getLink());
        $feed->setLink(null);
        $this->assertEquals(null, $feed->getLink());
    }

    public function testDescription()
    {
        $feed = new FeedItem();
        $result = $feed->setDescription('description');
        $this->assertEquals('description', $feed->getDescription());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testDescriptionEmptyOrNull()
    {
        $feed = new FeedItem();
        $feed->setDescription('');
        $this->assertEquals('', $feed->getDescription());
        $feed->setDescription(null);
        $this->assertEquals(null, $feed->getDescription());
    }

    public function testAuthor()
    {
        $feed = new FeedItem();
        $result = $feed->setAuthor('author');
        $this->assertEquals('author', $feed->getAuthor());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testAuthorEmptyOrNull()
    {
        $feed = new FeedItem();
        $feed->setAuthor('');
        $this->assertEquals('', $feed->getAuthor());
        $feed->setAuthor(null);
        $this->assertEquals(null, $feed->getAuthor());
    }

    public function testCategories()
    {
        $feed = new FeedItem();
        $firstCategory = new FeedItemCategory('category1');
        $secondCategory = new FeedItemCategory('category2');

        $result = $feed->setCategories(array($firstCategory));
        $this->assertInstanceOf(self::CLASS_NAME, $result);

        $result = $feed->addCategory($secondCategory);
        $this->assertInstanceOf(self::CLASS_NAME, $result);

        $categories = $feed->getCategories();
        $this->assertTrue(is_array($categories));
        $this->assertCount(2, $categories);
        $this->assertContains($firstCategory, $categories);
        $this->assertContains($secondCategory, $categories);
    }

    public function testAddCategory()
    {
        $feed = new FeedItem();
        $category = new FeedItemCategory('category');

        $result = $feed->addCategory($category);
        $this->assertInstanceOf(self::CLASS_NAME, $result);

        $categories = $feed->getCategories();
        $this->assertTrue(is_array($categories));
        $this->assertCount(1, $categories);
        $this->assertContains($category, $categories);
    }

    public function testComments()
    {
        $feed = new FeedItem();
        $result = $feed->setComments('author');
        $this->assertEquals('author', $feed->getComments());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testCommentsEmptyOrNull()
    {
        $feed = new FeedItem();
        $feed->setComments('');
        $this->assertEquals('', $feed->getComments());
        $feed->setComments(null);
        $this->assertEquals(null, $feed->getComments());
    }

    public function testEnclosures()
    {
        $feed = new FeedItem();
        $firstEnclosure = new FeedItemEnclosure('http://example.com/logo1.png', 'image/png');
        $secondEnclosure = new FeedItemEnclosure('http://example.com/logo2.png', 'image/png');

        $result = $feed->setEnclosures(array($firstEnclosure));
        $this->assertInstanceOf(self::CLASS_NAME, $result);

        $result = $feed->addEnclosure($secondEnclosure);
        $this->assertInstanceOf(self::CLASS_NAME, $result);

        $enclosures = $feed->getEnclosures();
        $this->assertTrue(is_array($enclosures));
        $this->assertCount(2, $enclosures);
        $this->assertContains($firstEnclosure, $enclosures);
        $this->assertContains($secondEnclosure, $enclosures);
    }

    public function testAddEnclosure()
    {
        $feed = new FeedItem();
        $enclosure = new FeedItemEnclosure('http://example.com/logo1.png', 'image/png');

        $result = $feed->addEnclosure($enclosure);
        $this->assertInstanceOf(self::CLASS_NAME, $result);

        $enclosures = $feed->getEnclosures();
        $this->assertTrue(is_array($enclosures));
        $this->assertCount(1, $enclosures);
        $this->assertContains($enclosure, $enclosures);
    }

    public function testGuid()
    {
        $feed = new FeedItem();
        $guid = new FeedItemGuid('http://example.com/article');

        $result = $feed->setGuid($guid);
        $this->assertSame($guid, $feed->getGuid());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testGuidNull()
    {
        $feed = new FeedItem();
        $feed->setGuid(null);
        $this->assertNull($feed->getGuid());
    }

    public function testPubDate()
    {
        $feed = new FeedItem();
        $date = new \DateTime();

        $result = $feed->setPubDate($date);
        $this->assertSame($date, $feed->getPubDate());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testPubDateNull()
    {
        $feed = new FeedItem();
        $feed->setPubDate(null);
        $this->assertNull($feed->getPubDate());
    }

    public function testSource()
    {
        $feed = new FeedItem();
        $source = new FeedItemSource('source');

        $result = $feed->setSource($source);
        $this->assertSame($source, $feed->getSource());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testSourceNull()
    {
        $feed = new FeedItem();
        $feed->setSource(null);
        $this->assertNull($feed->getSource());
    }

    public function testCustomValues()
    {
        $feed = new FeedItem();

        $result = $feed->setCustomValues(array('element1' => 'value1'));
        $this->assertInstanceOf(self::CLASS_NAME, $result);

        $result = $feed->addCustomValue('element2', 'value2');
        $this->assertInstanceOf(self::CLASS_NAME, $result);

        $customValues = $feed->getCustomValues();
        $this->assertTrue(is_array($customValues));
        $this->assertCount(2, $customValues);
        $this->assertArrayHasKey('element1', $customValues);
        $this->assertArrayHasKey('element2', $customValues);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCustomValuesEmpty()
    {
        $feed = new FeedItem();
        $feed->setCustomValues('');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCustomValuesNull()
    {
        $feed = new FeedItem();
        $feed->setCustomValues(null);
    }

    public function testAddCustomValue()
    {
        $feed = new FeedItem();

        $result = $feed->addCustomValue('element', 'value');
        $this->assertInstanceOf(self::CLASS_NAME, $result);

        $customValues = $feed->getCustomValues();
        $this->assertTrue(is_array($customValues));
        $this->assertCount(1, $customValues);
        $this->assertArrayHasKey('element', $customValues);
    }

    public function testRouteName()
    {
        $feed = new FeedItem();
        $result = $feed->setRouteName('route');
        $this->assertEquals('route', $feed->getRouteName());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testRouteNameEmptyOrNull()
    {
        $feed = new FeedItem();
        $feed->setRouteName('');
        $this->assertEquals('', $feed->getRouteName());
        $feed->setRouteName(null);
        $this->assertEquals(null, $feed->getRouteName());
    }

    public function testRouteParameters()
    {
        $feed = new FeedItem();
        $result = $feed->setRouteParameters(array('param' => 'value'));
        $this->assertTrue(is_array($feed->getRouteParameters()));
        $this->assertArrayHasKey('param', $feed->getRouteParameters());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }
}
