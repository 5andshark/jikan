<?php

namespace Jikan\Parser\Anime;

use Jikan\Model\PromoListItem;
use Jikan\Parser\ParserInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class PromoListItemParser
 *
 * @package Jikan\Parser\Episode
 */
class PromoListItemParser implements ParserInterface
{
    /**
     * @var Crawler
     */
    private $crawler;

    /**
     * PromoItemParser constructor.
     *
     * @param Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * @return PromoListItem
     */
    public function getModel(): PromoListItem
    {
        return PromoListItem::fromParser($this);
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->crawler->filterXPath('//a/div/span')->text();
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->crawler->filterXPath('//a/img')->attr('data-src');
    }

    /**
     * @return string
     */
    public function getVideoUrl(): string
    {
        return $this->crawler->filterXPath('//a')->attr('href');
    }
}