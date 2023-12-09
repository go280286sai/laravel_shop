<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order_status_description extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function order_status(): BelongsTo
    {
        return $this->belongsTo(Order_status::class);
    }

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
