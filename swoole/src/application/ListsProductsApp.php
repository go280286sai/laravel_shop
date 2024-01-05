<?php

namespace Root\Parser\application;

use function Laravel\Prompts\select;

require_once "simple_html_dom.php";

class ListsProductsApp
{
    private static array $list = [];
    private static string $base_url;

    private static function run(string $url)
    {
        self::$base_url = BaseUrl::get($url);
        $html = file_get_html($url);
        $last_page = intval($html->find('a.pagLast', 0)->innertext);
        self::get_lists($html->find('a.goodsItemLink'));
        for ($page = 2; $page <= $last_page; $page++) {
            $sub_url = '?page=' . $page . '&#goods_list';
            $html = file_get_html($url . $sub_url);
            self::get_lists($html->find('a.goodsItemLink'));
        }
    }

    private static function get_lists(array $urls)
    {
        foreach ($urls as $url) {
            self::$list[] = self::$base_url . $url->href;
        }
    }

    public static function get(string $url)
    {
        self::run($url);
        return self::$list;
    }
}