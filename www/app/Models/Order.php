<?php

namespace App\Models;

use App\Notifications\DeliveryNumberNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id', 'notes', 'status', 'total', 'qty',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order_products(): HasMany
    {
        return $this->hasMany(Order_product::class);
    }

    public function order_status(): BelongsTo
    {
        return $this->belongsTo(Order_status::class);
    }

    public static function add(array $data): mixed
    {
        $obj = new self();
        $obj->fill($data);
        $obj->save();

        return $obj->id;
    }

    public static function update_status(array $data, int $id): void
    {
        $obj = self::find($id);
        $obj->status_id = $data['status'];
        if ($data['status'] == 3) {
            $send = new self();
            $send->send_notification($obj->user_id, $data['delivery_number']);
        }
        if (isset($data['delivery_number'])) {
            $notes = json_decode($obj->notes);
            $notes->delivery_number = $data['delivery_number'];
            $obj->notes = json_encode($notes);
        }
        $obj->save();
    }

    public function send_notification(int $id, string $message): void
    {
        $user = User::find($id);
        $user->notify(new DeliveryNumberNotification($message));
    }

    public static function remove(int $id): void
    {
        self::find($id)->delete();
    }
}
