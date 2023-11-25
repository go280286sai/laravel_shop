<?php

namespace Database\Seeders;

use App\Models\Category_description;
use Illuminate\Database\Seeder;

class AddCategoryDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($j = 1; $j <= 36; $j++) {
            for ($i = 1; $i <= 3; $i++) {
                $lang = ['en', 'uk', 'ru'];
                $obj = new Category_description();
                $obj->category_id = $j;
                $obj->language_id = $i;
                $obj->title = 'Category_title_'.$lang[$i - 1].'_'.$j;
                $obj->description = 'Category_description_'.$lang[$i - 1].'_'.$j;
                $obj->keywords = 'Category_keywords_'.$lang[$i - 1].'_'.$j;
                $obj->content = 'Category_content_'.$lang[$i - 1].'_'.$j;
                $obj->save();
            }
        }
    }
}
