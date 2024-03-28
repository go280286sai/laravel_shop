<?php

namespace Root\Tests\app;

require_once "src/boot.php";

use PHPUnit\Framework\TestCase;
use Root\Parser\application\TitleApp;

/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

class TitleAppTest extends TestCase
{
    public function test_title()
    {
        $title = new TitleApp("https://bi.ua/ukr/konstruktori/");
        $this->assertEquals("Конструктори", $title->get());
    }
}






