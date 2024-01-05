<?php

namespace app;

use PHPUnit\Framework\TestCase;
use Root\Parser\application\ProductApp;
use Root\Parser\application\TitleApp;

/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

class ProductAppTest extends TestCase
{
    public function test_product()
    {
        $product = ProductApp::get('https://bi.ua/ukr/product/roliki-neon-combo-skate-sinie-30-33-nt09b4.html');
        $this->assertNotEmpty($product);
        print_r($product);}
}






