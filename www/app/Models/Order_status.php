<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order_status extends Model
{
    use HasFactory;

    public function order_status_description(): HasMany
    {
        return $this->hasMany(Order_status_description::class);
    }

    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
