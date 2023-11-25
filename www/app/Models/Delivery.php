<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Delivery extends Model
{
    use HasFactory;

    public function delivery_description(): HasMany
    {
        return $this->hasMany(Delivery_description::class);
    }

    public function order_products(): HasMany
    {
        return $this->hasMany(Order_product::class);
    }
}
