<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

namespace domain;

use PHPUnit\Framework\TestCase;
use Root\Parser\domain\entity\MainEntity;
use Root\Parser\domain\entity\MainsEntity;

class EntityTest extends TestCase
{
    public function test_main()
    {
        $main = new MainsEntity();
        $main->add('https://bi.ua/ukr/tovary-dlja-shkoly/');
        $result = $main->get();
        $this->assertNotEmpty($result);
        print_r($result);
    }
}
