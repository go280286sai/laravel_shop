<?php

namespace Database\Seeders;

use App\Models\Main;
use Illuminate\Database\Seeder;

class AddMainCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 5; $i++) {
            $obj = new Main();
            $obj->save();
        }
    }
}
