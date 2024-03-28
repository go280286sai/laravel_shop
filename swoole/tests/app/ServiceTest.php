<?php

namespace app;

require_once "src/boot.php";
use PHPUnit\Framework\TestCase;
use Root\Parser\application\Service;

/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

class ServiceTest extends TestCase
{
    public function test_json()
    {
        $data = Service::run('https://bi.ua/ukr/konstruktori/');
        $this->assertIsArray($data);
        print_r($data);
    }
}






