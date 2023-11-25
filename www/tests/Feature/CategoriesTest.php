<?php

namespace app\tests\Feature;

use App\Models\Category;
use App\Models\Category_description;
use App\Models\Main;
use App\Models\Main_description;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Request;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_add_category(): string
    {
        $title = [
            'main' => '1',
            'title_1' => 'title_1',
            'description_1' => 'description_1',
            'keywords_1' => 'keywords_1',
            'content_1' => 'content_1',
            'title_2' => 'title_2',
            'description_2' => 'description_2',
            'keywords_2' => 'keywords_2',
            'content_2' => 'content_2',
            'title_3' => 'title_3',
            'description_3' => 'description_3',
            'keywords_3' => 'keywords_3',
            'content_3' => 'content_3',
        ];
        Category::add($title);
        $this->assertDatabaseHas('category_descriptions', ['title' => 'title_1', 'description' => 'description_1',
            'keywords' => 'keywords_1', 'content' => 'content_1']);
        $this->assertDatabaseHas('category_descriptions', ['title' => 'title_2', 'description' => 'description_2',
            'keywords' => 'keywords_2', 'content' => 'content_2']);
        $this->assertDatabaseHas('category_descriptions', ['title' => 'title_3', 'description' => 'description_3',
            'keywords' => 'keywords_3', 'content' => 'content_3']);

        $id = Category_description::where('title', 'title_1')->first('category_id');

        return $id->category_id;
    }

    /**
     * @depends test_add_category
     */
    public function test_update_category($id): string
    {

        $title = [
            'main' => '1',
            'title_1' => 'title_1_1',
            'description_1' => 'description_1_1',
            'keywords_1' => 'keywords_1_1',
            'content_1' => 'content_1_1',
            'title_2' => 'title_2_1',
            'description_2' => 'description_2_1',
            'keywords_2' => 'keywords_2_1',
            'content_2' => 'content_2_1',
            'title_3' => 'title_3_1',
            'description_3' => 'description_3_1',
            'keywords_3' => 'keywords_3_1',
            'content_3' => 'content_3_1',
        ];
        Category_description::set_update($title, $id);
        $this->assertDatabaseHas('category_descriptions', ['title' => 'title_1_1', 'description' => 'description_1_1',
            'keywords' => 'keywords_1_1', 'content' => 'content_1_1']);
        $this->assertDatabaseHas('category_descriptions', ['title' => 'title_2_1', 'description' => 'description_2_1',
            'keywords' => 'keywords_2_1', 'content' => 'content_2_1']);
        $this->assertDatabaseHas('category_descriptions', ['title' => 'title_3_1', 'description' => 'description_3_1',
            'keywords' => 'keywords_3_1', 'content' => 'content_3_1']);

        return $id;
    }

    /**
     * @depends test_update_category
     */
    public function test_remove_main($id): void
    {
       Category::remove($id);
        $this->assertDatabaseMissing('category_descriptions', ['title' => 'title_1_1', 'description' => 'description_1_1',
            'keywords' => 'keywords_1_1', 'content' => 'content_1_1']);
        $this->assertDatabaseMissing('category_descriptions', ['title' => 'title_2_1', 'description' => 'description_2_1',
            'keywords' => 'keywords_2_1', 'content' => 'content_2_1']);
        $this->assertDatabaseMissing('category_descriptions', ['title' => 'title_3_1', 'description' => 'description_3_1',
            'keywords' => 'keywords_3_1', 'content' => 'content_3_1']);
    }
}
