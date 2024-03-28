<?php

namespace Root\Tests\app;

require_once "src/boot.php";
use PHPUnit\Framework\TestCase;
use Root\Parser\application\service\data\Cleaning;

/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

class CleanTest extends TestCase
{
    public function test_clean()
    {
        $files = new Cleaning();
        $result = $files->run();
        $this->assertTrue($result);
        print_r($result);
    }
}






