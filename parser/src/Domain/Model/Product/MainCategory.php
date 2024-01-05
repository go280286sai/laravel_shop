<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

namespace Root\Parser\Domain\Model\Product;

use Root\Parser\Domain\Model\ValueObjects\Main;
use Root\Parser\Domain\Model\ValueObjects\Url;
use Root\Parser\Infrostructure\Service\Parser\MainCategoryParser;

class MainCategory
{

    /**
     * @var string $main
     */
    protected static string $main;

    /**
     * @param string $url
     */
    public static function add(string $url): void
    {
        $main = new MainCategoryParser(new Url($url));
        $main->execute();
        self::$main = $main->getTitle();
    }

    /**
     * @return string
     */
    public static function all(): string
    {
        return self::$main;
    }
}