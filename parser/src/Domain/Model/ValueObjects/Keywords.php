<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

namespace Root\Parser\Domain\Model\ValueObjects;

class Keywords
{
    /**
     * @var array
     */
    private array $keywords;

    /**
     * @return array
     */
    public function getKeywords(): array
    {
        return $this->keywords;
    }

    /**
     * @param array $keywords
     */
    public function __construct(array $keywords)
    {
        $this->keywords = $keywords;
    }
}