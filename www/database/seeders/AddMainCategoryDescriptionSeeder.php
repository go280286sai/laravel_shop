<?php

namespace Database\Seeders;

use App\Models\Main_description;
use Illuminate\Database\Seeder;

class AddMainCategoryDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($j = 1; $j <= 3; $j++) {
            $lang = ['en', 'uk', 'ru'];
            for ($i = 1; $i <= 6; $i++) {
                $obj = new Main_description();
                $obj->main_id = $i;
                $obj->language_id = $j;
                $obj->title = 'Main_Category_'.$lang[$j - 1].'_'.$i;
                $obj->save();
            }
        }
    }
}
