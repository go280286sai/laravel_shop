<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User_comment extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param array $data
     * @return void
     */
    public static function add_comment(array $data): void
    {
        $obj = self::where('user_id', $data['id'])->first();

        if (! $obj) {
            $obj = new self();
        }

        $obj->user_id = $data['id'];
        $obj->comment = $data['content'];
        $obj->save();
    }
}
