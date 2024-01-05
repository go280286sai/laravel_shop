<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

namespace Root\Parser\Infrostructure\Service\Parser;

use Root\Parser\Domain\Model\ValueObjects\Title_is as Title;

require_once "simple_html_dom.php";
class MainCategoryParser extends MainParser
{
    private string $title;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $url
     * @return void
     */
    protected function getHtml(string $url): void
    {
        $html = file_get_html($url);
        $this->title = $html->find('h1', 0)->innertext;
    }

    /**
     * @return void
     */
    function execute(): void
    {
        $this->getHtml($this->getUrl());
    }
}