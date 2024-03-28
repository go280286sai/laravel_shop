<?php

namespace Root\Parser\application;

use Root\Parser\Infrostructure\Service\Logs\Error;
use Root\Parser\Infrostructure\Service\Logs\Parser;

class Service
{
    /**
     * @param string $url
     * @return bool
     */
    public static function run(string $url): bool
    {
        try {
            $object = array();

            echo "Parsing: " . $url . " is start \n";
            // Get main title
            $object['main'] = self::get_title($url);
            echo "Parsing: " . $object['main'] . " title \n";
            // Get categories
            $object['categories'] = self::get_categories($url);
            $count_categories = count($object['categories']);
            echo "Parsing: " . $count_categories . " categories \n";
            // Get products
            $count_element = 0;
            echo "Parsing: " . $count_element . " of " . $count_categories. "\n";

            foreach ($object['categories'] as $value) {
                $object['categories'][$count_element]['products'][] = self::get_products($value);
                $count_element++;
            }

            // End parsing
            echo "Parsing success \n";
            // Save json
            $json = json_encode($object, JSON_UNESCAPED_UNICODE);
            $file = fopen(__DIR__ . "/jsons/" . $object['main'] . ".json", "w");
            fwrite($file, $json);
            fclose($file);
            // Log
            Parser::log($url . " is parsed");

            return true;
        } catch (\Exception $e) {
            Error::log("Error: " . $e->getMessage() . " at line: " . $e->getLine());
            return false;
        }
    }

    /**
     * @param string $url
     * @return string
     */
    private static function get_title(string $url): string
    {
        $title = new TitleApp($url);
        return $title->get();
    }

    /**
     * @param string $url
     * @return array
     */
    private static function get_categories(string $url): array
    {
        $list = new ListCategoriesApp($url);
        return $list->get();
    }

    /**
     * @param array $objects
     * @return array
     */
    private static function get_products(array $objects): array
    {
        $products = array();

            $list = ListsProductsApp::get($objects['url']);
            $count_url_product = count($list);
            $count_element = 1;
            echo $count_element;
            foreach ($list as $url) {
                $products[] = ProductApp::get($url);
                echo "Parsing products: " . $count_element . " of " . $count_url_product . "\n";
                $count_element++;
                // Limit products
                if ($count_element == COUNT_PRODUCTS) {
                    break;
                }
            }

        return $products;
    }
}
