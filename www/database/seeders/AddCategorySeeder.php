<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class AddCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 6; $i++) {
            for ($j = 1; $j <= 6; $j++) {
                $obj = new Category();
                $obj->main_id = $i;
                $obj->save();
            }
        }
    }
}
