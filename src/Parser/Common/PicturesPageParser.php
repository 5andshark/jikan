<?php

namespace Jikan\Parser\Common;

use Jikan\Model\Picture;
use Jikan\Parser\ParserInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class PicturePageParser
 *
 * @package Jikan\Parser\Common
 */
class PicturesPageParser implements ParserInterface
{
    /**
     * @var Crawler
     */
    private $crawler;

    /**
     * AnimeParser constructor.
     *
     * @param Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * @return Picture[]
     */
    public function getModel(): array
    {
        return $pictureLinks = $this->crawler
            ->filterXPath('//a[@class="js-picture-gallery"]')
            ->each(function (Crawler $crawler) {
                return Picture::fromParser(new PictureParser($crawler));
            });
    }
}