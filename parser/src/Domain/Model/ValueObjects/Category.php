<?php
/*
 * Copyright (c) 2023. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Root\Parser\Domain\Model\ValueObjects;

/**
 * @see Category
 *
 */
class Category
{
    /**
     * @var string
     */
    public string $title;
    /**
     * @var string
     * @see Url
     */
    public string $url;
    /**
     * @var string
     */
    public string $img;

    /**
     * @param string $title
     * @param string $url
     * @param string $img
     */
    public function __construct(string $title, string $url, string $img)
    {
        $this->title = $title;
        $this->url = $url;
        $this->img = $img;
    }
}