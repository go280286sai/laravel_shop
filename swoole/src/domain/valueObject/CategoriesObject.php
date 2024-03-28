<?php

namespace Root\Parser\domain\valueObject;

class CategoriesObject
{
public array $categories;

    /**
     * @param array $categories
     */
    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }
}