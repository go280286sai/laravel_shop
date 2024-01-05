<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

namespace Root\Parser\Aplication\Usecase;

use Root\Parser\Domain\Model\Product\Category;
use Root\Parser\Domain\Model\Product\MainCategory;
use Root\Parser\Domain\Model\ValueObjects\Url;
use Root\Parser\Infrostructure\Service\Parser\ListCategory;

class ParserRunService
{
    /**
     * @var array
     */
    private static array $data = [];

    /**
     * @return array
     */
    public static function get(): array
    {
        return self::$data;
    }

    /**
     * @param string $url
     */
    public static function run(string $url)
    {
        $current_array = [];
        MainCategory::add($url);
        $current_array['main'] = MainCategory::all();
        Category::add($url);
        $current_array['category'] = Category::all();
        foreach ($current_array['category'] as  $value) {
            $current_array['list'][] = self::category_list($value->url);
        }
        self::$data[] = $current_array;
    }

    public static function category_list(string $url)
    {
        $list = new ListCategory(new Url($url));
        $list->execute();
        return $list->getList();
    }
}