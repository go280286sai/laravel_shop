<?php

namespace Root\Parser\domain\entity;

use Root\Parser\application\ListsProductsApp;
use Root\Parser\application\ProductApp;
use Root\Parser\domain\valueObject\ProductObject;

class ProductEntity
{

    /**
     * @param string $url
     * @return array
     */
    public static function get(string $url)
    {
        $list = ListsProductsApp::get($url);
        $products = [];
        foreach ($list as $key => $value) {
            $product = ProductApp::get($value);
            $products[] = new ProductObject($product['title'], $product['price'], $product['description'],
                $product['content'], $product['exerpt'], $product['images']);
        }
        return $products;
    }

}