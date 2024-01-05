<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

namespace Root\Parser\Domain\Model\Product;

use Root\Parser\Domain\Model\ValueObjects\Url;
use Root\Parser\Infrostructure\Service\Parser\CategoryParser;
use Root\Parser\Domain\Model\ValueObjects\Category as CategoryModel;


class Category
{
    /**
     * @var array
     */
    protected static array $category = [];
    protected static Product $product;

    /**
     * @return array
     */
    public static function all(): array
    {
        return self::$category;
    }

    /**
     * @param string $url
     */
    public static function add(string $url): void
    {
        $category = new CategoryParser(new Url($url));
        $category->execute();
        $dats = $category->getCategoryMap();
        foreach ($dats as $data) {
            self::$category[] = new CategoryModel($data['title'], $data['url'], $data['img']);
        }
    }

}