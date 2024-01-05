<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

use PHPUnit\Framework\TestCase;
use Root\Parser\Domain\Model\Aggregates\Mains;
use Root\Parser\Domain\Model\Product\Main;
use Root\Parser\Domain\Model\Product\MainDescription;
use Root\Parser\Domain\Model\ValueObjects\Id;
use Root\Parser\Domain\Model\ValueObjects\Language_id;
use Root\Parser\Domain\Model\ValueObjects\Title_is as Title;

class MainTest extends TestCase
{
    public static function data(): array
    {
        return [
            [1], [2], [3], [4], [5],
        ];
    }

    public static function data_description()
    {
        return [
            [1, [1,2,3]], [2, [1,2,3]], [3, [1,2,3]], [4, [1,2,3]], [5, [1,2,3]],
        ];
    }

    /**
     * @param int $n
     * @dataProvider data
     * @return void
     */
    public function test_main(int $n)
    {
        $main = new Main(new Id($n));
        $this->assertEquals($n, $main->getId()->getId());
    }

    /**
     * @dataProvider data_description
     * @return void
     */
    public function test_main_description(int $n, array $lang)
    {
        foreach ($lang as $l) {
        $description = new MainDescription(
            $n,
            new Language_id($l),
            new Title('test'),
        );
        $this->assertEquals($n, $description->getMainId());
        $this->assertEquals($l, $description->getLanguageId()->getId());
        $this->assertEquals('test', $description->getTitle()->getTitle());
    }
    }
    public function test_main_object()
    {
        $main = new Main(new Id(1));
        $description = new MainDescription(
            $main->getId()->getId(),
            new Language_id(1),
            new Title('test'),
        );
        $this->assertEquals($main->getId()->getId(), $description->getMainId());
        $this->assertEquals(1, $description->getLanguageId()->getId());
        $this->assertEquals('test', $description->getTitle()->getTitle());
    }

    public function test_main_agg()
    {
        $agg = new Mains(new MainDescription(1, new Language_id(1), new Title('test')));
        $this->assertEquals(1, $agg->getMain()->getId()->getId());
        $this->assertEquals(1, $agg->getMainDescription()->getLanguageId()->getId());
        $this->assertEquals('test', $agg->getMainDescription()->getTitle()->getTitle());
    }
}
