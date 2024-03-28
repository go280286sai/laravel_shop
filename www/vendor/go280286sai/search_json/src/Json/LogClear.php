<?php

namespace go280286sai\search_json\Json;

class LogClear extends Log
{
    /**
     * @return void
     */
    public static function clear(): void
    {
        $log = new self();
        $file = fopen($log->path, 'w');
        fclose($file);
    }
}
