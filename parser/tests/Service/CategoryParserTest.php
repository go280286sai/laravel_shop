<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

use PHPUnit\Framework\TestCase;
use Root\Parser\Aplication\Usecase\ParserRunService;
use Root\Parser\Domain\Model\Product\Category;
use Root\Parser\Domain\Model\Product\MainCategory;
use Root\Parser\Domain\Model\ValueObjects\Main;
use Root\Parser\Domain\Model\ValueObjects\Id;
use Root\Parser\Domain\Model\ValueObjects\Title_is as Title;
use Root\Parser\Domain\Model\ValueObjects\Url;
use Root\Parser\Infrostructure\Service\Parser\CategoryParser;
use Root\Parser\Infrostructure\Service\Parser\ListCategory;
use Root\Parser\Infrostructure\Service\Parser\MainCategoryParser;
use Root\Parser\Infrostructure\Service\Parser\ProductsParser;

class CategoryParserTest extends TestCase
{
//    public function test_main_category_parser()
//    {
//        MainCategory::add("https://bi.ua/ukr/konstruktori/");
//        MainCategory::add("https://bi.ua/ukr/myagkie-igrushki/");
//        $obj = MainCategory::all();
//        foreach ($obj as $value) {
//           $this->assertNotEmpty($value->title);
//        }
//    }

//    public function test_category_parser()
//    {
//        Category::add("https://bi.ua/ukr/konstruktori/");
//        $result = Category::all();
//        $this->assertNotEmpty($result);
//        foreach ($result as $value) {
//            $this->assertNotEmpty($value->title);
//            $this->assertNotEmpty($value->url);
//            $this->assertNotEmpty($value->img);
//        }
//    }

//    public function test_get_products()
//    {
//        $products = new ProductsParser(new Url("https://bi.ua/ukr/product/konstruktor-lego-harry-potter-hogvarts-taynaya-komnata-76389.html"));
//        $products->execute();
//        $result = $products->getProductMap();
//        print_r($result);
//        $this->assertNotEmpty($result);
//}

//    public function test_list_products()
//    {
//        $list = new ListCategory(new Url("https://bi.ua/ukr/konstruktori/konstruktori-s-unikalnimi-detalyami"));
//        $list->execute();
//        print_r($list->getList());
//}
    public function test_run()
    {
        ParserRunService::run('https://bi.ua/ukr/konstruktori/');
        print_r(ParserRunService::get());
    }
}
