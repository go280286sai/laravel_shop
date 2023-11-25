<?php

namespace Database\Seeders;

use App\Models\Gender_description;
use Illuminate\Database\Seeder;

class InsertNamesGenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $a = [['Male', 'Чоловiчий', 'Мужской'], ['Female', 'Жіночий', 'Женский'], ['Other', 'Другий', 'Другое'], ['Not specified', 'Не вказано', 'Не указано']];
        for ($i = 1; $i <= 4; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                $obj = new Gender_description();
                $obj->gender_id = $i;
                $obj->language_id = $j;
                $obj->name = $a[$i - 1][$j - 1];
                $obj->save();
            }
        }
    }
}
