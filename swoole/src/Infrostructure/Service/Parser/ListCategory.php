<?php
/*
 * Copyright (c) 2023.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

namespace Root\Parser\Infrostructure\Service\Parser;
use Root\Parser\Domain\Model\ValueObjects\Url;

require_once "simple_html_dom.php";
class ListCategory extends MainParser
{
    /**
     * @var array
     */
    private array $list;

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }

    /**
     * @param string $url
     * @return void
     */
    protected function getHtml(string $url): void
    {
            $html = file_get_html($url);
            $last_page = intval($html->find('a.pagLast', 0)->innertext);
            $this->get_lists($html->find('a.goodsItemLink'));
            for($page = 2; $page <= $last_page; $page++){
                $sub_url ='?page='.$page.'&#goods_list';
                $html = file_get_html($url.$sub_url);
                $this->get_lists($html->find('a.goodsItemLink'));
            }
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $this->getHtml($this->getUrl());
    }

    public function get_lists(array $urls)
    {
        foreach ($urls as $url) {
           $this->list[] = $this->getBaseUrl() .$url->href;
        }
    }
}
