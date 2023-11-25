<?php

namespace Database\Seeders;

use App\Models\Product_gallery;
use Illuminate\Database\Seeder;

class AddImgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($j = 1; $j <= 216; $j++) {
            for ($i = 1; $i <= 4; $i++) {
                Product_gallery::add($j, '/uploads/products/'.$i.'.jpg');
            }
        }
    }
}
