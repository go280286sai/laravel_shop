<?php

namespace Root\Parser\application;

class BaseUrl
{
    /**
     * @param string $url
     * @return string
     */
    public static function get(string $url): string
    {
        $parse_url = parse_url($url);
        return $parse_url["scheme"] . "://" . $parse_url["host"];
    }
}