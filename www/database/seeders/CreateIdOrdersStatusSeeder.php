<?php

namespace Database\Seeders;

use App\Models\Order_status;
use Illuminate\Database\Seeder;

class CreateIdOrdersStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 4; $i++) {
            $obj = new Order_status();
            $obj->save();
        }
    }
}
