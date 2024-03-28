<?php

namespace Root\Parser\domain\valueObject;

class CategoryObject
{
public string $title;
public string $url;
public string $image;

    /**
     * @param string $title
     * @param string $url
     * @param string $image
     */
    public function __construct(string $title, string $url, string $image)
    {
        $this->title = $title;
        $this->url = $url;
        $this->image = $image;
    }
}