<?php

namespace Argentum\FeedBundle\Tests\Feed;

use Argentum\FeedBundle\Feed\Feed;
use Argentum\FeedBundle\Feed\FeedCloud;
use Argentum\FeedBundle\Feed\FeedImage;
use Argentum\FeedBundle\Feed\FeedItem;
use Argentum\FeedBundle\Feed\FeedItemCategory;
use Argentum\FeedBundle\Feed\FeedTextInput;

/**
 * FeedTest
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedTest extends \PHPUnit_Framework_TestCase
{
    const CLASS_NAME = 'Argentum\FeedBundle\Feed\Feed';

    public function testConstructor()
    {
        $feed = new Feed();
        $this->assertInstanceOf(self::CLASS_NAME, $feed);
        $this->assertEquals('utf-8', $feed->getEncoding());
        $this->assertTrue(is_array($feed->getCategories()));
        $this->assertEmpty($feed->getCategories());
        $this->assertTrue(is_array($feed->getItems()));
        $this->assertEmpty($feed->getItems());
        $this->assertTrue(is_array($feed->getCustomElements()));
        $this->assertEmpty($feed->getCustomElements());
    }

    public function testTitle()
    {
        $feed = new Feed();
        $result = $feed->setTitle('title');
        $this->assertEquals('title', $feed->getTitle());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTitleEmpty()
    {
        $feed = new Feed();
        $feed->setTitle('');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTitleNull()
    {
        $feed = new Feed();
        $feed->setTitle(null);
    }

    public function testLink()
    {
        $feed = new Feed();
        $result = $feed->setLink('http://example.com');
        $this->assertEquals('http://example.com', $feed->getLink());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testLinkEmpty()
    {
        $feed = new Feed();
        $feed->setLink('');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testLinkNull()
    {
        $feed = new Feed();
        $feed->setLink(null);
    }

    public function testDescription()
    {
        $feed = new Feed();
        $result = $feed->setDescription('description');
        $this->assertEquals('description', $feed->getDescription());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDescriptionEmpty()
    {
        $feed = new Feed();
        $feed->setDescription('');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDescriptionNull()
    {
        $feed = new Feed();
        $feed->setDescription(null);
    }

    public function testLanguage()
    {
        $feed = new Feed();
        $result = $feed->setLanguage('en');
        $this->assertEquals('en', $feed->getLanguage());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testLanguageEmptyOrNull()
    {
        $feed = new Feed();
        $feed->setLanguage('');
        $this->assertEquals('', $feed->getLanguage());
        $feed->setLanguage(null);
        $this->assertEquals(null, $feed->getLanguage());
    }
    
    public function testCopyright()
    {
        $feed = new Feed();
        $result = $feed->setCopyright('copyright');
        $this->assertEquals('copyright', $feed->getCopyright());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testCopyrightEmptyOrNull()
    {
        $feed = new Feed();
        $feed->setCopyright('');
        $this->assertEquals('', $feed->getCopyright());
        $feed->setCopyright(null);
        $this->assertEquals(null, $feed->getCopyright());
    }
    
    public function testManagingEditor()
    {
        $feed = new Feed();
        $result = $feed->setManagingEditor('managing editor');
        $this->assertEquals('managing editor', $feed->getManagingEditor());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testManagingEditorEmptyOrNull()
    {
        $feed = new Feed();
        $feed->setManagingEditor('');
        $this->assertEquals('', $feed->getManagingEditor());
        $feed->setManagingEditor(null);
        $this->assertEquals(null, $feed->getManagingEditor());
    }
    
    public function testWebMaster()
    {
        $feed = new Feed();
        $result = $feed->setWebMaster('web master');
        $this->assertEquals('web master', $feed->getWebMaster());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testWebMasterEmptyOrNull()
    {
        $feed = new Feed();
        $feed->setWebMaster('');
        $this->assertEquals('', $feed->getWebMaster());
        $feed->setWebMaster(null);
        $this->assertEquals(null, $feed->getWebMaster());
    }
    
    public function testPubDate()
    {
        $feed = new Feed();
        $date = new \DateTime('2014-05-21 00:00:00');
        $result = $feed->setPubDate($date);
        $this->assertSame($date, $feed->getPubDate());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testPubDateString()
    {
        $feed = new Feed();
        $date = '2014-05-21 00:00:00';
        $feed->setPubDate($date);
        $this->assertInstanceOf('\DateTime', $feed->getPubDate());
        $this->assertEquals($date, $feed->getPubDate()->format('Y-m-d H:i:s'));
    }

    public function testPubDateEmptyOrNull()
    {
        $feed = new Feed();
        $date = new \DateTime();
        $feed->setPubDate('');
        $this->assertInstanceOf('\DateTime', $feed->getPubDate());
        $this->assertLessThan(3, $feed->getPubDate()->getTimestamp() - $date->getTimestamp());
        $feed->setPubDate(null);
        $this->assertInstanceOf('\DateTime', $feed->getPubDate());
        $this->assertLessThan(3, $feed->getPubDate()->getTimestamp() - $date->getTimestamp());
    }
    
    public function testLastBuildDate()
    {
        $feed = new Feed();
        $date = new \DateTime('2014-05-21 00:00:00');
        $result = $feed->setLastBuildDate($date);
        $this->assertSame($date, $feed->getLastBuildDate());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testLastBuildDateString()
    {
        $feed = new Feed();
        $date = '2014-05-21 00:00:00';
        $feed->setLastBuildDate($date);
        $this->assertInstanceOf('\DateTime', $feed->getLastBuildDate());
        $this->assertEquals($date, $feed->getLastBuildDate()->format('Y-m-d H:i:s'));
    }

    public function testLastBuildDateEmptyOrNull()
    {
        $feed = new Feed();
        $date = new \DateTime();
        $feed->setLastBuildDate('');
        $this->assertInstanceOf('\DateTime', $feed->getLastBuildDate());
        $this->assertLessThan(3, $feed->getLastBuildDate()->getTimestamp() - $date->getTimestamp());
        $feed->setLastBuildDate(null);
        $this->assertInstanceOf('\DateTime', $feed->getLastBuildDate());
        $this->assertLessThan(3, $feed->getLastBuildDate()->getTimestamp() - $date->getTimestamp());
    }

    public function testCategories()
    {
        $feed = new Feed();
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

    public function testAddCategoryObject()
    {
        $feed = new Feed();
        $category = new FeedItemCategory('category');

        $result = $feed->addCategory($category);
        $this->assertInstanceOf(self::CLASS_NAME, $result);

        $categories = $feed->getCategories();
        $this->assertTrue(is_array($categories));
        $this->assertCount(1, $categories);
        $this->assertContains($category, $categories);
    }

    public function testAddCategoryArray()
    {
        $feed = new Feed();
        $category = array('title' => 'category');

        $result = $feed->addCategory($category);
        $this->assertInstanceOf(self::CLASS_NAME, $result);

        $categories = $feed->getCategories();
        $this->assertTrue(is_array($categories));
        $this->assertCount(1, $categories);
        $this->assertInstanceOf('Argentum\FeedBundle\Feed\FeedItemCategory', $categories[0]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddCategoryEmpty()
    {
        $feed = new Feed();
        $feed->addCategory('');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddCategoryNull()
    {
        $feed = new Feed();
        $feed->addCategory(null);
    }

    public function testGenerator()
    {
        $feed = new Feed();
        $result = $feed->setGenerator('generator');
        $this->assertEquals('generator', $feed->getGenerator());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testGeneratorEmpty()
    {
        $feed = new Feed();
        $feed->setGenerator('');
        $this->assertEquals('', $feed->getGenerator());
    }

    public function testDocs()
    {
        $feed = new Feed();
        $result = $feed->setDocs('docs');
        $this->assertEquals('docs', $feed->getDocs());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testDocsEmptyOrNull()
    {
        $feed = new Feed();
        $feed->setDocs('');
        $this->assertEquals('', $feed->getDocs());
        $feed->setDocs(null);
        $this->assertEquals(null, $feed->getDocs());
    }

    public function testCloudObject()
    {
        $feed = new Feed();
        $cloud = new FeedCloud('domain', 80, '/xmlrpc', 'register', 'xmlrpc');

        $result = $feed->setCloud($cloud);
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertInstanceOf('Argentum\FeedBundle\Feed\FeedCloud', $feed->getCloud());
        $this->assertSame($cloud, $feed->getCloud());
    }

    public function testCloudArray()
    {
        $feed = new Feed();
        $cloudArray = array(
            'domain' => 'domain',
            'port' => 80,
            'path' => '/xmlrpc',
            'registerProcedure' => 'register',
            'protocol' => 'xmlrpc',
        );

        $result = $feed->setCloud($cloudArray);
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertInstanceOf('Argentum\FeedBundle\Feed\FeedCloud', $feed->getCloud());
        $this->assertEquals($cloudArray['domain'], $feed->getCloud()->getDomain());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCloudEmpty()
    {
        $feed = new Feed();
        $feed->setCloud('');
    }

    public function testCloudNull()
    {
        $feed = new Feed();
        $result = $feed->setCloud(null);
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertEquals(null, $feed->getCloud());
    }

    public function testTtl()
    {
        $feed = new Feed();
        $result = $feed->setTtl(300);
        $this->assertEquals(300, $feed->getTtl());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTtlNegative()
    {
        $feed = new Feed();
        $feed->setTtl(-1);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTtlEmpty()
    {
        $feed = new Feed();
        $feed->setTtl('');
    }

    public function testTtlNull()
    {
        $feed = new Feed();
        $feed->setTtl(1);
        $result = $feed->setTtl(null);
        $this->assertEquals(null, $feed->getTtl());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testImageObject()
    {
        $feed = new Feed();
        $image = new FeedImage('http://example.com/logo.png', 'image', 'http://example.com');

        $result = $feed->setImage($image);
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertInstanceOf('Argentum\FeedBundle\Feed\FeedImage', $feed->getImage());
        $this->assertSame($image, $feed->getImage());
    }

    public function testImageArray()
    {
        $feed = new Feed();
        $imageArray = array(
            'url' => 'http://example.com/logo.png',
            'title' => 'image',
            'link' => 'http://example.com',
        );

        $result = $feed->setImage($imageArray);
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertInstanceOf('Argentum\FeedBundle\Feed\FeedImage', $feed->getImage());
        $this->assertEquals($imageArray['url'], $feed->getImage()->getUrl());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testImageEmpty()
    {
        $feed = new Feed();
        $feed->setImage('');
    }

    public function testImageNull()
    {
        $feed = new Feed();
        $result = $feed->setImage(null);
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertEquals(null, $feed->getImage());
    }

    public function testRating()
    {
        $feed = new Feed();
        $result = $feed->setRating('rating');
        $this->assertEquals('rating', $feed->getRating());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    public function testRatingEmptyOrNull()
    {
        $feed = new Feed();
        $feed->setRating('');
        $this->assertEquals('', $feed->getRating());
        $feed->setRating(null);
        $this->assertEquals(null, $feed->getRating());
    }

    public function testTextInputObject()
    {
        $feed = new Feed();
        $textInput = new FeedTextInput('title', 'description', 'name', 'http://example.com');

        $result = $feed->setTextInput($textInput);
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertInstanceOf('Argentum\FeedBundle\Feed\FeedTextInput', $feed->getTextInput());
        $this->assertSame($textInput, $feed->getTextInput());
    }

    public function testTextInputArray()
    {
        $feed = new Feed();
        $textInputArray = array(
            'title' => 'title',
            'description' => 'description',
            'name' => 'name',
            'link' => 'http://example.com',
        );

        $result = $feed->setTextInput($textInputArray);
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertInstanceOf('Argentum\FeedBundle\Feed\FeedTextInput', $feed->getTextInput());
        $this->assertEquals($textInputArray['link'], $feed->getTextInput()->getLink());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTextInputEmpty()
    {
        $feed = new Feed();
        $feed->setTextInput('');
    }

    public function testTextInputNull()
    {
        $feed = new Feed();
        $result = $feed->setTextInput(null);
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertEquals(null, $feed->getTextInput());
    }

    public function testSkipHours()
    {
        $feed = new Feed();
        $hours = array(3, 1, 2, 2, null, -1);

        $result = $feed->setSkipHours($hours);
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertTrue(is_array($feed->getSkipHours()));
        $this->assertEquals(array(1, 2, 3), $feed->getSkipHours());
    }

    public function testSkipDays()
    {
        $feed = new Feed();
        $days = array('Monday', 'Saturday', 'Saturday', '', null);

        $result = $feed->setSkipDays($days);
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertTrue(is_array($feed->getSkipDays()));
        $this->assertEquals(array('Monday', 'Saturday'), $feed->getSkipDays());
    }

    public function testNamespaces()
    {
        $feed = new Feed();

        $result = $feed->setNamespaces(array('default' => 'http://example.com'));
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertTrue(is_array($feed->getNamespaces()));
        $this->assertCount(1, $feed->getNamespaces());
        $this->assertArrayHasKey('default', $feed->getNamespaces());

        $feed->addNamespace('http://example.com/advanced', 'advanced');
        $this->assertCount(2, $feed->getNamespaces());
        $this->assertArrayHasKey('advanced', $feed->getNamespaces());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddNamespaceEmpty()
    {
        $feed = new Feed();
        $feed->addNamespace('');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddNamespaceNull()
    {
        $feed = new Feed();
        $feed->addNamespace(null);
    }

    public function testCustomElements()
    {
        $feed = new Feed();
        $feed->addNamespace('http://example.com', 'advanced');
        $elements = array('advanced:element1', 'advanced:element2');

        $result = $feed->setCustomElements($elements);
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertTrue(is_array($feed->getCustomElements()));
        $this->assertEquals($elements, $feed->getCustomElements());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddCustomElementWithinUnknownNamespace()
    {
        $feed = new Feed();
        $feed->addCustomElement('advanced:element');
    }

    public function testEncoding()
    {
        $feed = new Feed();
        $result = $feed->setEncoding('windows-1251');
        $this->assertEquals('windows-1251', $feed->getEncoding());
        $this->assertInstanceOf(self::CLASS_NAME, $result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEncodingEmpty()
    {
        $feed = new Feed();
        $feed->setEncoding('');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEncodingNull()
    {
        $feed = new Feed();
        $feed->setEncoding(null);
    }

    public function testTranslationDomain()
    {
        $feed = new Feed();
        $result = $feed->setTranslationDomain('news');
        $this->assertEquals('news', $feed->getTranslationDomain());
        $this->assertInstanceOf(self::CLASS_NAME, $result);

        $feed->setTranslationDomain(null);
        $this->assertEquals('messages', $feed->getTranslationDomain());
    }

    public function testSetChannel()
    {
        $feed = new Feed();
        $channel = array(
            'title' => 'title',
            'namespaces' => array('advanced' => 'http://example.com'),
            'customElements' => array('advanced:element'),
            'field' => 'value',
        );

        $result = $feed->setChannel($channel);
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertEquals('title', $feed->getTitle());
        $this->assertArrayHasKey('advanced', $feed->getNamespaces());
        $this->assertContains('advanced:element', $feed->getCustomElements());
        $this->assertArrayHasKey('field', $feed->getChannel());
    }

    public function testItems()
    {
        $feed = new Feed();
        $item1 = new FeedItem();
        $item2 = new FeedItem();

        $result = $feed->setItems(array($item1));
        $this->assertInstanceOf(self::CLASS_NAME, $result);

        $this->assertTrue(is_array($feed->getItems()));
        $this->assertCount(1, $feed->getItems());
        $this->assertContains($item1, $feed->getItems());

        $feed->addItem($item2);

        $this->assertTrue(is_array($feed->getItems()));
        $this->assertCount(2, $feed->getItems());
        $this->assertContains($item1, $feed->getItems());
    }

    public function testAddFeedableItems()
    {
        $item = $this->getMock('Argentum\FeedBundle\Feed\FeedItem');

        $feedable = $this->getMock('Argentum\FeedBundle\Feed\Feedable');
        $feedable
            ->expects($this->once())
            ->method('getFeedItem')
            ->will($this->returnValue($item));

        $feed = new Feed();
        $feed->addFeedableItems(array($feedable));
        $items = $feed->getItems();
        $this->assertCount(1, $items);
        $this->assertSame($item, $items[0]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddFeedableItemsNull()
    {
        $feed = new Feed();
        $feed->addFeedableItems(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddFeedableItemsWrongObject()
    {
        $feed = new Feed();
        $feed->addFeedableItems(array(new FeedItem()));
    }

    public function testRenderer()
    {
        $feed = new Feed();

        $renderer = $this->getMock('Argentum\FeedBundle\Renderer\RendererInterface');
        $renderer
            ->expects($this->once())
            ->method('render')
            ->will($this->returnValue('rendered'));

        $result = $feed->setRenderer($renderer);
        $this->assertInstanceOf(self::CLASS_NAME, $result);
        $this->assertSame($renderer, $feed->getRenderer());
        $this->assertEquals('rendered', $feed->render());
    }
}
