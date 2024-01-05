<?php

namespace Root\Parser\domain\entity;

use Root\Parser\application\TitleApp;

class MainEntity
{
    /**
     * @var string
     */
    public string $title;
    private CategoryEntity $category;

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->getTitle($url);
        $this->category = new CategoryEntity($url);
    }

    /**
     * @param string $url
     * @return void
     */
    private function getTitle(string $url): void
    {
        $obj = new TitleApp($url);
        $this->title = $obj->title;
    }
}