<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order_product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'order_id', 'product_id', 'payment_id', 'delivery_id', 'title', 'slug', 'qty', 'price', 'sum',
    ];

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * @return BelongsTo
     */
    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }

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
