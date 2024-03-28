<?php
/*
 * @copyright 2024.
 * @author Aleksandr Storchak <go280286sai@gmail.com>
 */

function base_url(string $url): string
{
    $parse_url = parse_url($url);

    return $parse_url["scheme"] . "://" . $parse_url["host"];
}





