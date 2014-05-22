<?php

namespace Argentum\FeedBundle\Tests\Feed;

use Argentum\FeedBundle\Feed\FeedItemCategory;

/**
 * FeedItemCategoryTest
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedItemCategoryTest extends \PHPUnit_Framework_TestCase
{
    const CLASS_NAME = 'Argentum\FeedBundle\Feed\FeedItemCategory';

    /**
     * @var FeedItemCategory
     */
    private $category;

    protected function setUp()
    {
        $this->category = new FeedItemCategory('title', 'domain');
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(self::CLASS_NAME, $this->category);
        $this->assertEquals('title', $this->category->getTitle());
        $this->assertEquals('domain', $this->category->getDomain());
    }

    public function testCreateFromArray()
    {
        $categoryArray = array(
            'title' => 'title',
            'domain' => 'domain',
        );

        $category = FeedItemCategory::createFromArray($categoryArray);
        $this->assertInstanceOf(self::CLASS_NAME, $this->category);
        $this->assertEquals($categoryArray['title'], $category->getTitle());
        $this->assertEquals($categoryArray['domain'], $category->getDomain());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTitleNull()
    {
        $this->category->setTitle(null);
    }

    public function testDomainNull()
    {
        $this->category->setDomain(null);
        $this->assertEquals(null, $this->category->getDomain());
    }
}
