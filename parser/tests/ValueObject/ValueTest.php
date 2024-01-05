<?php

namespace Root\Tests\ValueObject;

use PHPUnit\Framework\TestCase;
use Root\Parser\Domain\Model\ValueObjects\Content;
use Root\Parser\Domain\Model\ValueObjects\Description_is as Description;
use Root\Parser\Domain\Model\ValueObjects\Exerpt;
use Root\Parser\Domain\Model\ValueObjects\Img;
use Root\Parser\Domain\Model\ValueObjects\Language_id;
use Root\Parser\Domain\Model\ValueObjects\Title_is as Title;
use Root\Parser\Domain\Model\ValueObjects\Keywords;
use Root\Parser\Domain\Model\ValueObjects\Url;

class ValueTest extends TestCase
{
    public static function data(): array
    {
        return [
            [1], [2], [3],
        ];
    }

    public function test_title()
    {
        $title = new Title('title');
        $getTitle = $title->getTitle();
        $this->assertEquals("title", $getTitle);
    }

    public function test_content()
    {
        $content = new Content('content');
        $getContent = $content->getContent();
        $this->assertEquals("content", $getContent);
    }

    public function test_description()
    {
        $description = new Description('description');
        $getDescription = $description->getDescription();
        $this->assertEquals("description", $getDescription);
    }

    public function test_exerpt()
    {
        $exerpt = new Exerpt('exerpt');
        $getExerpt = $exerpt->getExerpt();
        $this->assertEquals("exerpt", $getExerpt);
    }

    public function test_keywords()
    {
        $keywords = new Keywords(['keyword1', 'keyword2']);
        $getKeywords = $keywords->getKeywords();
        $this->assertEquals(["keyword1", "keyword2"], $getKeywords);
    }

    /**
     * @dataProvider data
     * @return void
     */
    public function test_language(int $id)
    {
        $language = new Language_id($id);
        $this->assertEquals($id, $language->getId());
    }

    public function test_url()
    {
        $url = new Url("https://example.com");
        $this->assertEquals("https://example.com", $url->getUrl());
    }

    public function test_img()
    {
        $img = new Img("pic.png");
        $this->assertEquals("pic.png", $img->getImg());
    }
}
