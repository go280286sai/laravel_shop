<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

namespace Root\Parser\Domain\Model\ValueObjects;

class Exerpt
{
    /**
     * @var string
     */
    private string $exerpt;

    /**
     * @param string $exerpt
     */
    public function __construct(string $exerpt)
    {
        $this->exerpt = $exerpt;
    }

    /**
     * @return string
     */
    public function getExerpt(): string
    {
        return $this->exerpt;
    }
}