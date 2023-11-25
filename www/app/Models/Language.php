<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    use HasFactory;

    public function product_description(): HasMany
    {
        return $this->hasMany(Product_description::class);
    }

    public function category_descriptions(): HasMany
    {
        return $this->hasMany(Category_description::class);
    }

    public function main_descriptions(): HasMany
    {
        return $this->hasMany(Main_description::class);
    }

    public function delivery_descriptions(): HasMany
    {
        return $this->hasMany(Delivery_description::class);
    }

    public function payment_descriptions(): HasMany
    {
        return $this->hasMany(Payment_description::class);
    }

    public function gender_descriptions(): HasMany
    {
        return $this->hasMany(Gender_description::class);
    }

    public static function getStatus(): object|int
    {
        $lang = app()->getLocale();

        return self::where('code', $lang)->get()[0];
    }
}
