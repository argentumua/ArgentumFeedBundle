ArgentumFeedBundle
==================

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/020f9643-8b15-4542-9f19-7e8fdc86d392/mini.png)](https://insight.sensiolabs.com/projects/020f9643-8b15-4542-9f19-7e8fdc86d392)
[![Build Status](https://travis-ci.org/argentumua/ArgentumFeedBundle.svg?branch=master)](https://travis-ci.org/argentumua/ArgentumFeedBundle)
[![Coverage Status](https://img.shields.io/coveralls/argentumua/ArgentumFeedBundle.svg)](https://coveralls.io/r/argentumua/ArgentumFeedBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/argentumua/ArgentumFeedBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/argentumua/ArgentumFeedBundle/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/argentum/feed-bundle/v/stable.svg)](https://packagist.org/packages/argentum/feed-bundle)
[![License](https://poser.pugx.org/argentum/feed-bundle/license.svg)](https://packagist.org/packages/argentum/feed-bundle)

ArgentumFeedBundle allows you to create a set of feeds for your content with
different settings. All predefined settings can be overridden at runtime.

You can create your own Feed classes and Renderers by defining a service with
tag ```argentum_feed.feed``` and ```argentum_feed.renderer``` respectively.

Usage
-----

Render a predefined feed:
```php
$rss = $this->get('argentum_feed.factory')
    ->createFeed('news')
    ->addFeedableItems($news)
    ->render();
```
where ```$news``` is a collection of ```News``` entities.

To get it to work your ```News``` entity should implement ```Feedable``` interface:
```php
use Argentum\FeedBundle\Feed\Feedable;
use Argentum\FeedBundle\Feed\FeedItem;
use Argentum\FeedBundle\Feed\FeedItemEnclosure;
use Argentum\FeedBundle\Feed\FeedItemSource;

class News implements Feedable
{
    // ...

    /**
     * Returns FeedItem instance.
     *
     * @return FeedItem
     */
    public function getFeedItem()
    {
        $item = new FeedItem();

        $item
            ->setRouteName('news_show')
            ->setRouteParameters([
                'category' => $this->getCategory()->getSlug(),
                'id' => $this->getId(),
                'slug' => $this->getSlug(),
            ])
            ->setTitle($this->getTitle())
            ->setDescription($this->getAnnounce())
            ->setPubDate($this->getPublishedAt())
            ->addCustomValue('yandex:full-text', $this->getBody())
            ->addCustomValue('mailru:full-text', $this->getBody());

        if ($this->getImageMedium()) {
            $item->addEnclosure(
                new FeedItemEnclosure($this->getImageMedium()['path'], 'image/jpeg')
            );
        }

        if ($this->getSourceTitle()) {
            $item->setSource(
                new FeedItemSource($this->getSourceTitle(), $this->getSourceUrl())
            );
        }

        return $item;
    }
}
```

Also you can specify a data source provider in the configuration:
```yml
argentum_feed:
    channels:
        news:
            title: 'News'
            link: '/'
            description: 'News feed'
            provider:
                repository: 'ArgentumNewsBundle:News'
                method: 'findAllPublished'
                arguments: [10, 'ru']
```
and then you can just create the feed and render it:
```php
$rss = $this->get('argentum_feed.factory')
    ->createFeed('news')
    ->render();
```

Configuration
-------------

Full configuration:
```yml
argentum_feed:
    channels:
        news:
            title: 'News'
            link: '/'
            description: 'News feed'
            language: 'ru'
            copyright: 'ACME'
            managingEditor: 'Editor'
            webMaster: 'Webmaster'
            pubDate: 'now'
            lastBuildDate: 'now'
            categories:
                - { title: 'Category 1', domain: 'domain' }
                - { title: 'Category 2' }
            generator: 'ArgentumFeedBundle'
            docs: 'docs'
            cloud:
                domain: 'domain.tld'
                port: 80
                path: '/'
                registerProcedure: 'register'
                protocol: 'xmlrpc'
            ttl: 300
            image:
                url: '/images/logo.png'
                title: 'News'
                link: '/'
                width: 128
                height: 96
                description: 'News'
            rating: 'Best'
            textInput:
                title: 'Title'
                description: 'Description'
                name: 'name'
                link: 'http://domain.tld'
            skipHours: [0, 1, 2, 3, 4, 5, 6, 7, 8]
            skipDays:
                - 'Saturday'
                - 'Sunday'
            namespaces:
                default: 'http://backend.userland.com/rss2'
                yandex: 'http://news.yandex.ru'
                mailru: 'http://news.mail.ru'
            customElements:
                - 'yandex:full-text'
                - 'mailru:full-text'
            encoding: 'utf-8'
            translationDomain: 'news'
            feed: 'feed'
            renderer: 'rss'
            provider:
                repository: 'ArgentumNewsBundle:News'
                method: 'findAllPublished'
                arguments: [10, 'ru']
```

Minimal configuration:
```yml
argentum_feed:
    channels:
        news:
            title: 'News'
            link: '/'
            description: 'News feed'
```

All relative links will be converted to absolute using request host.
All text content from the predefined configuration will be translated using specified translationDomain.
