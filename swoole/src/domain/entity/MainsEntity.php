<?php

namespace Root\Parser\domain\entity;

class MainsEntity
{
    /**
     * @var array $mains
     */
    private array $mains;

    /**
     * @param ...$urls
     * @return void
     */
    public function add(...$urls): void
    {
        foreach ($urls as $url) {
            $this->mains[] = new MainEntity($url);
        }
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->mains;
    }
}