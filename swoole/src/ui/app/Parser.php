<?php

namespace Root\Parser\ui\app;

use Root\Parser\application\Service;

class Parser implements SelectInterface
{

    /**
     * @param string|null $token
     * @param string|null $url
     * @return bool
     */
    public function run(?string $token = null, ?string $url = null): bool
    {
        return Service::run($url);
    }
}