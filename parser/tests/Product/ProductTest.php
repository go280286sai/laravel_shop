<?php

namespace Root\Tests\Product;


use PHPUnit\Framework\TestCase;
use Root\Parser\Domain\Model\Product\ProductDescription;
use Root\Parser\Domain\Model\ValueObjects\Content;
use Root\Parser\Domain\Model\ValueObjects\Description_is;
use Root\Parser\Domain\Model\ValueObjects\Exerpt;
use Root\Parser\Domain\Model\ValueObjects\Keywords;
use Root\Parser\Domain\Model\ValueObjects\Title_is as Title;

class ProductTest extends TestCase
{
    /**
     * @return void
     */
    public function test_product()
    {
        $product = new ProductDescription(new Title('title'), new Content('content'),
            new Description_is('description'), new Exerpt('exerpt'), new Keywords(['keyword1', 'keyword2']));

        // is instance of Product and all subclasses
        $this->assertInstanceOf(ProductDescription::class, $product);
        $this->assertInstanceOf(Title::class, $product->getTitle());
        $this->assertInstanceOf(Content::class, $product->getContent());
        $this->assertInstanceOf(Description_is::class, $product->getDescription());
        $this->assertInstanceOf(Exerpt::class, $product->getExerpt());
        $this->assertInstanceOf(Keywords::class, $product->getKeywords());

        // get values from sub classes
        $this->assertEquals('title', $product->getTitle()->getTitle());
        $this->assertEquals('content', $product->getContent()->getContent());
        $this->assertEquals('description', $product->getDescription()->getDescription());
        $this->assertEquals('exerpt', $product->getExerpt()->getExerpt());
        $this->assertEquals(['keyword1', 'keyword2'], $product->getKeywords()->getKeywords());

    }
}
