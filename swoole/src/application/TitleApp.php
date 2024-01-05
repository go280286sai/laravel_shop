<?php
namespace Root\Parser\application;

include 'simple_html_dom.php';
class TitleApp
{
    private string $title;
    public function __construct(string $url)
    {
        $html = file_get_html($url);
        $this->title = $html->find('h1', 0)->innertext;
    }
    public function get(){
        return htmlentities($this->title, ENT_QUOTES, 'UTF-8');
    }
}