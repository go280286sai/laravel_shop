<?php

namespace Root\Parser\ui\app;

use Exception;
use Root\Parser\application\service\data\Cleaning;
use Root\Parser\Infrostructure\Service\Logs\Error;

class Clean implements SelectInterface
{

    /**
     * @param string|null $token
     * @param string|null $url
     * @return bool
     */
    public function run(?string $token = null, ?string $url = null): bool
    {
        try {
            $clean = new Cleaning();
            $clean->run();

            return true;
        } catch (Exception $e) {
            Error::log("Error: " . $e->getMessage() . " at line: " . $e->getLine());

            return false;
        }
    }
}
