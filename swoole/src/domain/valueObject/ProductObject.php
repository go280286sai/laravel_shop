<?php

namespace Root\Parser\domain\valueObject;

class ProductObject
{
    /**
     * @var string
     */
    public string $title;
    /**
     * @var string
     */
    public string $price;
    /**
     * @var string
     */
    public string $description;
    /**
     * @var string
     */
    public string $content;
    /**
     * @var string
     */
    public string $exerpt;
    /**
     * @var array
     */
    public array $images;

    /**
     * @param string $title
     * @param string $price
     * @param string $description
     * @param string $content
     * @param string $exerpt
     * @param array $images
     */
    public function __construct(string $title, string $price, string $description, string $content, string $exerpt, array $images)
    {
        $this->title = $title;
        $this->price = $price;
        $this->description = $description;
        $this->content = $content;
        $this->exerpt = $exerpt;
        $this->images = $images;
    }
}