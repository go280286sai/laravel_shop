<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

namespace Root\Parser\Domain\Model\ValueObjects;

class Content
{
    /**
     * @var string
     */
    private string $content;

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }
}