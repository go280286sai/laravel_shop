<?php

namespace Root\Parser\application;
use Iterator;

require_once "simple_html_dom.php";

class ListCategoriesApp
{
    /**
     * @var string
     */
    private string $base_url;
    /**
     * @var array
     */
    private array $list;

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->list;
    }

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $url_parse = parse_url($url);
        $this->base_url = $url_parse["scheme"] . "://" . $url_parse["host"];
        $this->getList($url);
    }

    /**
     * @param string $url
     * @return void
     */
    private function getList(string $url): void
    {
        $html = file_get_html($url);
        $list = [];
        foreach ($html->find('a.catItem') as $element) {
            $category = $element->innertext;
            $elements = [];
            $elements['title'] = trim(strip_tags($category));
            $elements['url'] = $this->base_url . $element->href;
            $list[] = $elements;
        }
        foreach ($this->get_category_img($html, $this->base_url) as $key => $value) {
            $list[$key]['img'] = $value;
        }

        $this->list = $list;
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