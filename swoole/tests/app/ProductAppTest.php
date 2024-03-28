<?php

namespace Root\Tests\app;

use PHPUnit\Framework\TestCase;
use Root\Parser\application\ProductApp;

/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */
require_once "src/boot.php";

class ProductAppTest extends TestCase
{
    public function test_product()
    {
        $product = ProductApp::get('https://bi.ua/ukr/product/roliki-neon-combo-skate-sinie-30-33-nt09b4.html');
        $this->assertNotEmpty($product);
        print_r($product);}
}






