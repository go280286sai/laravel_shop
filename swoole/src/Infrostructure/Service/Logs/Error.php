<?php

namespace Root\Parser\Infrostructure\Service\Logs;

use DateTime;

class Error extends Logs
{
    /**
     * @param string $text
     * @return void
     */
    public static function log(string $text): void
    {
        $time = new DateTime();
        $err = new self();
        $err->write("Error: " . $text . ", in time: " . $time->format('d-m-Y H:i:s' . PHP_EOL));
    }
}