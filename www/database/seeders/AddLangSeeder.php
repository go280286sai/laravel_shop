<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class AddLangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lang = ['English' => 'en', 'Ukrainian' => 'uk', 'Russian' => 'ru'];
        foreach ($lang as $key => $value) {
            $ob = new Language();
            $ob->code = $value;
            $ob->title = $key;
            $ob->save();
        }
    }
}
