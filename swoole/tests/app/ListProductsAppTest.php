<?php

namespace app;

use PHPUnit\Framework\TestCase;
use Root\Parser\application\ListsProductsApp;
use Root\Parser\application\TitleApp;

/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

class ListProductsAppTest extends TestCase
{
    public function test_list_products()
    {
        $list = ListsProductsApp::get('https://bi.ua/ukr/detskij-transport/roliki/');
        $this->assertNotEmpty($list);
        print_r($list);
    }
}






