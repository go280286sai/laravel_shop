<?php

namespace Root\Parser\ui\app;

use GuzzleHttp\Exception\GuzzleException;
use Root\Parser\application\service\data\SendFile;

class Download implements SelectInterface
{


    /**
     * @param string|null $token
     * @param string|null $url
     * @return bool
     * @throws GuzzleException
     */
    public function run(?string $token = null, ?string $url = null): bool
    {
        $file = new SendFile($token);

        return $file->run();
    }
}