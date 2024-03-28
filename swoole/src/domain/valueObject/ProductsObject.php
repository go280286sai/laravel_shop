<?php

namespace Root\Parser\domain\valueObject;

class ProductsObject
{
    /**
     * @var array
     */
    public array $products;

    /**
     * @param object|array $products
     */
    public function __construct(object|array $products)
    {
        $this->products[] = $products;
    }
}