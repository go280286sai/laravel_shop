<?php

namespace Database\Seeders;

use App\Models\Order_status_description;
use Illuminate\Database\Seeder;

class CreateTitleOrdersStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mas = [
            ['new', 'processing', 'completed', 'canceled'],
            ['новий', 'в обробці', 'завершено', 'відмінено'],
            ['новый', 'в обработке', 'выполнен', 'отменен'],
        ];
        for ($j = 1; $j <= 3; $j++) {
            for ($i = 1; $i <= 4; $i++) {
                $obj = new Order_status_description();
                $obj->order_status_id = $i;
                $obj->title = $mas[$j - 1][$i - 1];
                $obj->language_id = $j;
                $obj->save();

            }
        }
    }
}
