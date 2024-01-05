<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

namespace Root\Parser\Infrostructure\Service\Parser;

use Iterator;


require_once "simple_html_dom.php";

class CategoryParser extends MainParser
{
    /**
     * @var array
     */
    private array $category_map = array();

    /**
     * @return array
     */
    public function getCategoryMap(): array
    {
        return $this->category_map;
    }

    /**
     * @var object
     */
    private object $html;

    /**
     * @param string $url
     * @return void
     */
    protected function getHtml(string $url): void
    {
        $this->html = file_get_html($url);
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $this->getHtml($this->getUrl());
        foreach ($this->html->find('a.catItem') as $element) {
            $category = $element->innertext;
            $elements = [];
            $elements['title'] = trim(strip_tags($category));
            $elements['url'] = $this->getBaseUrl() . $element->href;
            $this->category_map[] = $elements;
        }
        foreach ($this->get_category_img($this->html, $this->getBaseUrl()) as $key => $value) {
            $this->category_map[$key]['img'] = $value;
        }
    }


    /**
     * @param object $html
     * @param string $base_url
     * @return Iterator
     */
    protected function get_category_img(object $html, string $base_url): Iterator
    {
        foreach ($html->find('img.itemImg.p01') as $element) {
            $image_path = explode('/', $element->src);
            file_put_contents(__DIR__ . "/Images/Categories/" . $image_path[4], file_get_contents($base_url . $element->src));
            yield $image_path[4];
        }
    }

}