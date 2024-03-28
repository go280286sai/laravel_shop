<?php

namespace Root\Parser\ui\app;

interface SelectInterface
{
    /**
     * @param string|null $token
     * @param string|null $url
     * @return bool
     */
    public function run(?string $token = null, ?string $url = null): bool;
}