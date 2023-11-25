<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AddUserSeeder::class);
        $this->call(AddLangSeeder::class);
        $this->call(SlidersSeeder::class);
        $this->call(AddMainCategorySeeder::class);
        $this->call(AddMainCategoryDescriptionSeeder::class);
        $this->call(AddCategorySeeder::class);
        $this->call(AddCategoryDescriptionSeeder::class);
        $this->call(AddProductsSeeder::class);
        $this->call(AddProductDescriptionSeeder::class);
        $this->call(AddImgSeeder::class);
        $this->call(InsertIdGenderSeeder::class);
        $this->call(InsertNamesGenderSeeder::class);
        $this->call(AddIdDeliveriesSeeder::class);
        $this->call(AddNamesDeliveriesSeeder::class);
        $this->call(AddIdPaymentsSeeder::class);
        $this->call(AddNamesPaymentsSeeder::class);
        $this->call(CreateIdOrdersStatusSeeder::class);
        $this->call(CreateTitleOrdersStatusSeeder::class);
    }
}
