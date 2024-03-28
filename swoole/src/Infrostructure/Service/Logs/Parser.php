<?php

namespace Root\Parser\Infrostructure\Service\Logs;

class Parser extends Logs
{
    /**
     * @param string $text
     * @return void
     */
    public static function log(string $text): void
    {
        $time = new \DateTime();
        $err = new self();
        $err->write("Success: " . $text . ", in time: " . $time->format('d-m-Y H:i:s' . PHP_EOL));
    }
}
