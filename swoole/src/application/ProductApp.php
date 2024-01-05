<?php

namespace Root\Parser\application;

use function Laravel\Prompts\select;

require_once "simple_html_dom.php";

class ProductApp
{
    private static $base_url;

    public static function get(string $url)
    {
        self::$base_url = BaseUrl::get($url);
        $html = file_get_html($url);

        $products = [];
        $products['title'] = $html->find('h1', 0)->innertext;
        $products['price'] = $html->find('p.costIco', 0)->innertext;

        foreach ($html->find('meta[name="description"]') as $element) {
            $products['description'] = $element->content;
        }

        $products['content'] = ltrim($html->find('article', 0)->innertext);
        $products['content'] .= rtrim($html->find('div.bordered', 0)->innertext);
//        $products['exerpt'] = $html->find('article p', 0)->innertext;
        $products['exerpt'] = "exer";

        $img_array = [];
        foreach ($html->find('img.pnav') as $element) {
            $img_array[] = $element->src;
        }
        $products['images'] = GetProductImagesApp::get(self::$base_url, $img_array);
        return $products;
    }
}