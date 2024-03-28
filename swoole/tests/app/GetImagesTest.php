<?php

namespace Root\Tests\app;

require_once "src/boot.php";
use PHPUnit\Framework\TestCase;
use Root\Parser\application\GetProductImagesApp;

/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

class GetImagesTest extends TestCase
{
    public function test_img()
    {
        $images =  [
        'https://i.ytimg.com/vi/2KPUaBVKufU/default.jpg',
       '/uploaded-images/products/size_60/582812_1.jpg',
        '/uploaded-images/products_photos/size_60/582812_2.jpg#2',
        '/uploaded-images/products_photos/size_60/582812_3.jpg#3',
        '/uploaded-images/products_photos/size_60/582812_4.jpg#4',
        '/uploaded-images/products_photos/size_60/582812_5.jpg#5',
        '/uploaded-images/products_photos/size_60/582812_6.jpg#6',
        '/uploaded-images/products_photos/size_60/582812_7.jpg#7'];
        $list = GetProductImagesApp::get("https://bi.ua/", $images);
        $this->assertNotEmpty($list);
        print_r($list);
    }
}






