<?php

namespace go280286sai\search_json\Json;

class LogMessage extends Log
{
    /**
     * @param string $text
     * @return void
     */
    public static function send(string $text): void
    {
        $log = new self();
        $log->write($text);
    }
}
