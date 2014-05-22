<?php

namespace Argentum\FeedBundle\Tests\Feed;

use Argentum\FeedBundle\Feed\FeedTextInput;

/**
 * FeedTextInputTest
 *
 * @author     Vadim Borodavko <javer@argentum.ua>
 * @copyright  Argentum IT Lab, http://argentum.ua
 */
class FeedTextInputTest extends \PHPUnit_Framework_TestCase
{
    const CLASS_NAME = 'Argentum\FeedBundle\Feed\FeedTextInput';

    /**
     * @var FeedTextInput
     */
    private $textInput;

    protected function setUp()
    {
        $this->textInput = new FeedTextInput('title', 'description', 'name', 'http://example.com');
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(self::CLASS_NAME, $this->textInput);
        $this->assertEquals('title', $this->textInput->getTitle());
        $this->assertEquals('description', $this->textInput->getDescription());
        $this->assertEquals('name', $this->textInput->getName());
        $this->assertEquals('http://example.com', $this->textInput->getLink());
    }

    public function testCreateFromArray()
    {
        $textInputArray = array(
            'title' => 'title',
            'description' => 'description',
            'name' => 'name',
            'link' => 'http://example.com',
        );

        $cloud = FeedTextInput::createFromArray($textInputArray);
        $this->assertInstanceOf(self::CLASS_NAME, $this->textInput);
        $this->assertEquals($textInputArray['title'], $cloud->getTitle());
        $this->assertEquals($textInputArray['description'], $cloud->getDescription());
        $this->assertEquals($textInputArray['name'], $cloud->getName());
        $this->assertEquals($textInputArray['link'], $cloud->getLink());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTitleNull()
    {
        $this->textInput->setTitle(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDescriptionNull()
    {
        $this->textInput->setDescription(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNameNull()
    {
        $this->textInput->setName(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testLinkNull()
    {
        $this->textInput->setLink(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testLinkIncorrect()
    {
        $this->textInput->setLink('some text');
    }
}
