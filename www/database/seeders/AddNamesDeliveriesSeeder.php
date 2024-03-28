<?php

namespace Database\Seeders;

use App\Models\Delivery_description;
use Illuminate\Database\Seeder;

class AddNamesDeliveriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deliverys = [
            'Нова пошта', 'Укрпошта',
        ];
        for ($i = 1; $i <= 2; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                $obj = new Delivery_description();
                $obj->delivery_id = $i;
                $obj->language_id = $j;
                $obj->title = $deliverys[$i - 1];
                $obj->description = $deliverys[$i - 1];
                $obj->save();
            }
        }
    }
}
