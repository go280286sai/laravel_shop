<?php

namespace Tests\Feature;

use App\Models\Main;
use App\Models\Main_description;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Request;
use Tests\TestCase;

class MainCategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_add_main(): string
    {
        $title = ['main_description_1' => 'title_uk', 'main_description_2' => 'title_ru', 'main_description_3' => 'title_en'];
        Main::add($title);
        $this->assertDatabaseHas('main_descriptions', ['title' => 'title_uk']);
        $this->assertDatabaseHas('main_descriptions', ['title' => 'title_ru']);
        $this->assertDatabaseHas('main_descriptions', ['title' => 'title_en']);
        $id = Main_description::where('title', 'title_uk')->first('main_id');

        return $id->main_id;
    }

    /**
     * @depends  test_add_main
     */
    public function test_update_main($id): string
    {

        $title = ['main_description_1' => 'title_uk_1', 'main_description_2' => 'title_ru_1', 'main_description_3' => 'title_en_1'];
        Main_description::set_update($title, $id);
        $this->assertDatabaseHas('main_descriptions', ['title' => 'title_uk_1']);
        $this->assertDatabaseHas('main_descriptions', ['title' => 'title_ru_1']);
        $this->assertDatabaseHas('main_descriptions', ['title' => 'title_en_1']);

        return $id;
    }

    /**
     * @depends test_update_main
     */
    public function test_remove_main($id): void
    {
        Main::remove($id);
        $this->assertDatabaseMissing('main_descriptions', ['title' => 'title_uk_1']);
        $this->assertDatabaseMissing('main_descriptions', ['title' => 'title_ru_1']);
        $this->assertDatabaseMissing('main_descriptions', ['title' => 'title_en_1']);
    }
}
