<?php

namespace Root\Parser\domain\entity;
use Root\Parser\application\ListCategoriesApp;
use Root\Parser\domain\valueObject\CategoriesObject;
use Root\Parser\domain\valueObject\CategoryObject;
use Root\Parser\domain\valueObject\ProductsObject;

class CategoryEntity
{
private array $categoryObject;
private ProductsObject $productsObject;


    /**
     * @param $url
     */
    public function __construct($url)
    {
        $list = new ListCategoriesApp($url);
        $categories = [];
        $result = $list->get();
        foreach ($result as $key => $value) {
            $categories[$key] = $value;
            $categories[$key]['products'] = ProductEntity::get($value['url']);
            echo $value['url'];
        }
         $this->categoryObject = $categories;
    }
}