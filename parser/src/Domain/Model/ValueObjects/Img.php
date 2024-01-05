<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

namespace Root\Parser\Domain\Model\ValueObjects;

class Img
{
    /**
     * @var string
     */
    private string $img;

    /**
     * @param string $img
     */
    public function __construct(string $img)
    {
        $this->img = $img;
    }

    /**
     * @return string
     */
    public function getImg(): string
    {
        return $this->img;
    }
}