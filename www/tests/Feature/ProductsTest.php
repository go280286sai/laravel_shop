<?php

namespace app\tests\Feature;

use App\Models\Category;
use App\Models\Category_description;
use App\Models\Main;
use App\Models\Main_description;
use App\Models\Product;
use App\Models\Product_description;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Request;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_add_product(): string
    {
        $title = [
            'title_1' => 'title_1',
            'content_1' => 'content_1',
            'exerpt_1' => 'exerpt_1',
            'keywords_1' => 'keywords_1',
            'description_1' => 'description_1',
            'title_2' => 'title_2',
            'content_2' => 'content_2',
            'exerpt_2' => 'exerpt_2',
            'keywords_2' => 'keywords_2',
            'description_2' => 'description_2',
            'title_3' => 'title_3',
            'content_3' => 'content_3',
            'exerpt_3' => 'exerpt_3',
            'keywords_3' => 'keywords_3',
            'description_3' => 'description_3',
            'category' => '1',
            'new_price' => '500',
            'amount' => '30',
            'img' => fake()->url(),
        ];
        Product::add($title);
        $this->assertDatabaseHas('products', ['price' => '500', 'amount' => '30']);
        $this->assertDatabaseHas('product_descriptions', ['title' => 'title_1', 'content' => 'content_1',
            'exerpt' => 'exerpt_1', 'keywords' => 'keywords_1', 'description' => 'description_1']);
        $this->assertDatabaseHas('product_descriptions', ['title' => 'title_2', 'content' => 'content_2',
            'exerpt' => 'exerpt_2', 'keywords' => 'keywords_2', 'description' => 'description_2']);
        $this->assertDatabaseHas('product_descriptions', ['title' => 'title_3', 'content' => 'content_3',
            'exerpt' => 'exerpt_3', 'keywords' => 'keywords_3', 'description' => 'description_3']);


        $id = Product_description::where('title', 'title_1')->first('product_id');

        return $id->product_id;
    }

    /**
     * @depends test_add_product
     */
    public function test_update_product($id): string
    {

        $title = [
            'title_1' => 'title_1_test',
            'content_1' => 'content_1_test',
            'exerpt_1' => 'exerpt_1_test',
            'keywords_1' => 'keywords_1_test',
            'description_1' => 'description_1_test',
            'title_2' => 'title_2_test',
            'content_2' => 'content_2_test',
            'exerpt_2' => 'exerpt_2_test',
            'keywords_2' => 'keywords_2_test',
            'description_2' => 'description_2_test',
            'title_3' => 'title_3_test',
            'content_3' => 'content_3_test',
            'exerpt_3' => 'exerpt_3_test',
            'keywords_3' => 'keywords_3_test',
            'description_3' => 'description_3_test',
            'category' => '1',
            'new_price' => '800',
            'amount' => '50',
            'img' => fake()->url(),
        ];
        Product::set_update($title, $id);
        $this->assertDatabaseHas('products', ['price' => '800', 'amount' => '50']);
        $this->assertDatabaseHas('product_descriptions', ['title' => 'title_1_test', 'content' => 'content_1_test',
            'exerpt' => 'exerpt_1_test', 'keywords' => 'keywords_1_test', 'description' => 'description_1_test']);
        $this->assertDatabaseHas('product_descriptions', ['title' => 'title_2_test', 'content' => 'content_2_test',
            'exerpt' => 'exerpt_2_test', 'keywords' => 'keywords_2_test', 'description' => 'description_2_test']);
        $this->assertDatabaseHas('product_descriptions', ['title' => 'title_3_test', 'content' => 'content_3_test',
            'exerpt' => 'exerpt_3_test', 'keywords' => 'keywords_3_test', 'description' => 'description_3_test']);

        return $id;
    }

    /**
     * @depends test_update_product
     */
    public function test_remove_product($id): void
    {
        Product::remove($id);
        $this->assertDatabaseMissing('products', ['price' => '800', 'amount' => '50']);
        $this->assertDatabaseMissing('product_descriptions', ['title' => 'title_1_test', 'content' => 'content_1_test',
            'exerpt' => 'exerpt_1_test', 'keywords' => 'keywords_1_test', 'description' => 'description_1_test']);
        $this->assertDatabaseMissing('product_descriptions', ['title' => 'title_2_test', 'content' => 'content_2_test',
            'exerpt' => 'exerpt_2_test', 'keywords' => 'keywords_2_test', 'description' => 'description_2_test']);
        $this->assertDatabaseMissing('product_descriptions', ['title' => 'title_3_test', 'content' => 'content_3_test',
            'exerpt' => 'exerpt_3_test', 'keywords' => 'keywords_3_test', 'description' => 'description_3_test']);
    }
}
