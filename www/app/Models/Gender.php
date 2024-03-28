<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gender extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function gender_descriptions(): HasMany
    {
        return $this->hasMany(Gender_description::class);
    }

    /**
     * @return HasMany
     */
    public function user_descriptions(): HasMany
    {
        return $this->hasMany(User_description::class);
    }
}
