<?php
/**
 * Get title
 *
 * @author Aleksandr Storchak <go280286sai@gmail.com>
 */

namespace Root\Parser\application;
/**
 * Get title
 */
class TitleApp
{
    /**
     * @var string
     */
    public string $title;

    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $html = file_get_html($url);
        $this->title = $html->find('h1', 0)->innertext;
    }

    /**
     * Get title main category
     *
     * @author Aleksandr Storchak <go280286sai@gmail.com>
     * @return string
     */
    public function get(): string
    {
        return $this->title;
    }
}