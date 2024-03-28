<?php

namespace Root\Parser\Infrostructure\Service\Logs;

class Logs
{
    /**
     * @var object
     */
    protected $file;

    public function __construct()
    {
        $this->file = fopen(__DIR__."/logs.txt", "a");
    }

    /**
     * @param string $text
     * @return void
     */
    public function write(string $text): void
    {
        fwrite($this->file, $text);
}
    /**
     *
     */
    public function __destruct()
    {
        fclose($this->file);
    }
}