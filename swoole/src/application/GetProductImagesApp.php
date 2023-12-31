<?php

namespace Root\Parser\application;

class GetProductImagesApp
{
    public static function get(string $base_url, array $urls): array
    {
        $images = [];
        foreach ($urls as $url) {
            $image_path = explode('/', $url);
            $image_path[0] = $base_url;
            $image_path[3] = "size_400";
            if (strstr($image_path[4], "#")) {
                $search = strstr($image_path[4], "#");
                $image_path[4] = str_replace($search, '', $image_path[4]);
            }
            $path = implode('/', $image_path);
            if (file_exists("images/" . $image_path[4])) {
                unlink("images/" . $image_path[4]);
            }
            if (file_exists($path) && $image_path[2] == 'products') {
                $image_path[2] = "products_photos";
            }
            $path = implode('/', $image_path);
            file_put_contents(__DIR__ . "/Images/Products/" . $image_path[4], file_get_contents($path));
            $images[] = $image_path[4];
        }
        return $images;
    }
}