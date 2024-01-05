<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */
namespace Root\Parser\Infrostructure\Service\Parser\Category;

use Root\Parser\Domain\Model\ValueObjects\Url;
use Root\Parser\Domain\Model\ValueObjects\Title_is as Title;

abstract class MainCategoryParser
{
    private Url $url;
    private Title $title;

    /**
     * @return Title
     */
    abstract public function getTitle(): Title;
    private string $base_url;

    /**
     * @param Url $url
     */
    public function __construct(Url $url)
    {
        $this->url = $url;
        $this->setBaseUrl($url->getUrl());
    }

    /**
     * @return Url
     */
    protected function getUrl(): Url
    {
        return $this->url;
    }

    /**
     * @return string
     */
    protected function getBaseUrl(): string
    {
        return $this->base_url;
    }

    /**
     * @param string $base_url
     * @return void
     */
    protected function setBaseUrl(string $base_url): void
    {
        $url_parse = parse_url($base_url);
        $this->base_url = $url_parse["scheme"] . "://" . $url_parse["host"];
    }
    abstract protected function get_category_img(object $html, string $base_url);
    abstract protected function getHtml(string $url): void;
}