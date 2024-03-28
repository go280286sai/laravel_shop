<?php

namespace app;

require_once "src/boot.php";
use PHPUnit\Framework\TestCase;
use Root\Parser\application\service\data\Cleaning;
use Root\Parser\application\service\data\SendFile;

/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

class SendFileTest extends TestCase
{
    public function test_send()
    {
        $files = new SendFile("28|kiIXSYBFbg1qBoE2MzHOLlbtLtbCCDdCn7cs5ood14456038");
        $result = $files->run();
        $this->assertTrue($result);
        print_r($result);
    }
}






