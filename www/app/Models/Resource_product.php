<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource_product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'url'];


    /**
     * @param array $data
     * @return void
     */
    public static function add(array $data): void
    {
        $obj = new self();
        $obj->fill($data);
        $obj->save();
    }
}
