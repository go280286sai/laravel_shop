<?php
/**
 * @copyright  2024
 * @author Aleksandr Storchak <go280286sai@gmail.com>
 */

namespace Root\Parser\application;

/**
 * Class ListsProductsApp
 * Get list of products
 * @author Aleksandr Storchak <go280286sai@gmail.com>
 */
class ListsProductsApp
{
    /**
     * @var array
     */
    private static array $list = [];
    /**
     * @var string
     */
    private static string $base_url;

    /**
     * @param string $url
     * @return void
     */
    private static function run(string $url): void
    {
        try {
            self::$base_url = base_url($url);
            $html = file_get_html($url);
            $last_page = intval($html->find('a.pagLast', 0)->innertext);
            self::get_lists($html->find('a.goodsItemLink'));
            for ($page = 2; $page <= $last_page; $page++) {
                $sub_url = '?page=' . $page . '&#goods_list';
                $html = file_get_html($url . $sub_url);
                self::get_lists($html->find('a.goodsItemLink'));
                // Limit products
                if (count(self::$list) >= COUNT_PRODUCTS + COUNT_PRODUCTS * 0.2) {
                    break;
                }
            }
        }
        catch (\Exception $e) {
        echo $e->getMessage();
        }
    }

    /**
     * @param array $urls
     * @return void
     */
    private static function get_lists(array $urls): void
    {
        foreach ($urls as $url) {
            self::$list[] = self::$base_url . $url->href;
        }
    }

    /**
     * @param string $url
     * @return array
     */
    public static function get(string $url): array
    {
        self::run($url);
        $result = self::$list;
        self::$list = [];
        return $result;
    }
}
