<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

namespace Root\Parser\Infrostructure\Service\Parser;

class ProductsParser extends MainParser
{
    /**
     * @var array
     */
    private array $product_map = array();

    /**
     * @return array
     */
    public function getProductMap(): array
    {
        return $this->product_map;
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $this->getHtml($this->getUrl()->getUrl());
    }

    /**
     * @param string $url
     * @return void
     */
    protected function getHtml(string $url): void
    {
        $html = file_get_html($url);

        $this->product_map['title'] = $html->find('h1', 0)->innertext;
        $this->product_map['price'] = $html->find('p.costIco', 0)->innertext;

        foreach ($html->find('meta[name="description"]') as $element) {
            $this->product_map['description'] = $element->content;
        }

        $this->product_map['content'] = ltrim($html->find('article', 0)->innertext);
        $this->product_map['content'] .=rtrim($html->find('div.bordered', 0)->innertext);
        $this->product_map['exerpt'] = $html->find('article p', 0)->innertext;

        $img_array = [];
        foreach ($html->find('img.pnav') as $element) {
            $img_array[] = $element->src;
        }
        $this->product_map['images'] = $this->get_images($this->getBaseUrl(), $img_array);

    }
    protected function get_images(string $base_url, array $urls):array
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