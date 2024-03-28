<?php

namespace app;

require_once "src/boot.php";
use PHPUnit\Framework\TestCase;
use Root\Parser\application\ListCategoriesApp;

/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

class ListCategoriesAppTest extends TestCase
{
    public function test_list()
    {
        $list = new ListCategoriesApp("https://bi.ua/ukr/konstruktori/");
        $result = $list->get();
        $this->assertNotEmpty($result);
        $this->assertIsArray($result);
        print_r($result);
    }
}






