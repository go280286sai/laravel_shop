<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User_description;
use Illuminate\Database\Seeder;

class AddUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new User();
        $obj->name = 'admin';
        $obj->email = 'admin@admin.ua';
        $obj->password = bcrypt('12345678');
        $obj->status = 1;
        $obj->is_admin = 1;
        $obj->save();
    }
}
