<?php
/**
 * @copyright 2024.
 * @author Aleksandr Storchak <go280286sai@gmail.com>
 */

namespace Root\Parser\application;
/**
 * Class ProductApp
 * Get products
 * @author Aleksandr Storchak <go280286sai@gmail.com>
 */
class ProductApp
{
    /**
     * @var string
     */
    private static string $base_url;

    /**
     * @param string $url
     * @return array
     */
    public static function get(string $url): array
    {
        self::$base_url = base_url($url);
        $html = file_get_html($url);

        $products = [];
        $products['title'] = $html->find('h1', 0)->innertext;
        $products['price'] = $html->find('p.costIco', 0)->innertext;

        foreach ($html->find('meta[name="description"]') as $element) {
            $products['description'] = $element->content;
        }

        $products['content'] = ltrim($html->find('article', 0)->innertext);
        $products['content'] .= rtrim($html->find('div.bordered', 0)->innertext);
        $products['exerpt'] = $html->find('article p', 0)->innertext;

        $img_array = [];
        foreach ($html->find('img.pnav') as $element) {
            $img_array[] = $element->src;
        }
        $products['images'] = GetProductImagesApp::get(self::$base_url, $img_array);

        return $products;
    }
}
