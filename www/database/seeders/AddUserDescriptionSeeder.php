<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User_description;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddUserDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = User::find(1);
        $desc = new User_description();
        $desc->user_id = $obj->id;
        $desc->last_name = 'admin';
        $desc->gender_id = 1;
        $desc->save();
    }
}
