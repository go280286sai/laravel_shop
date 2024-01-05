<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

namespace Root\Parser\Infrostructure\Service\Parser;
use Root\Parser\Domain\Model\ValueObjects\Url;
abstract class MainParser
{
    /**
     * @var string
     */
    private string $url;
    /**
     * @var string
     */
    private string $base_url;

    /**
     * @param Url $url
     */
    public function __construct(Url $url)
    {
        $this->url = $url->getUrl();
        $this->setBaseUrl($url->getUrl());
    }

    /**
     * @return string
     */
    protected function getUrl(): string
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

    /**
     * @param string $url
     * @return void
     */
    abstract protected function getHtml(string $url): void;
    abstract public function execute(): void;
}