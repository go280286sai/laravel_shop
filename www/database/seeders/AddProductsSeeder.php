<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class AddProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 36; $i++) {
            for ($j = 1; $j <= 6; $j++) {
                $price = rand(100, 1000);
                $obj = new Product();
                $obj->category_id = $i;
                $obj->slug = 'slug_'.$i.'_'.$j;
                $obj->price = $price;
                $obj->old_price = $price - $price * 0.2;
                $obj->status = 1;
                $obj->hit = 1;
                $obj->img = 'uploads/img/no-image.jpg';
                $obj->amount = 10;
                $obj->save();
            }
        }
    }
}
