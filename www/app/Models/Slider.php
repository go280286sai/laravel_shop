<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public static function add(string $slider): void
    {
        $obj = new self();
        $obj->img = $slider;
        $obj->save();
    }

    public static function edit(int $id, string $slider): void
    {
        $obj = self::find($id);
        $obj->img = $slider;
        $obj->save();
    }

    public static function remove(int $id): void
    {
        self::find($id)->delete();
    }
}
