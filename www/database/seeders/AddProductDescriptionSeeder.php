<?php

namespace Database\Seeders;

use App\Models\Product_description;
use Illuminate\Database\Seeder;

class AddProductDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($j = 1; $j <= 216; $j++) {
            for ($i = 1; $i <= 3; $i++) {
                $lang = ['en', 'uk', 'ru'];
                $obj = new Product_description();
                $obj->product_id = $j;
                $obj->language_id = $i;
                $obj->title = 'Product_'.$j.'_'.$lang[$i - 1];
                $obj->description = 'Description_'.$j.'_'.$lang[$i - 1];
                $obj->keywords = 'Keywords_'.$j.'_'.$lang[$i - 1];
                $obj->content = 'Content_'.$j.'_'.$lang[$i - 1];
                $obj->exerpt = 'Exerpt_'.$j.'_'.$lang[$i - 1];
                $obj->save();
            }
        }
    }
}
