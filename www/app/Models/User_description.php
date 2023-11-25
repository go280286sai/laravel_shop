<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_description extends Model
{
    use HasFactory, softDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['user_id', 'gender_id', 'last_name', 'birthday', 'phone'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public static function set_update(int $id, array $data): true
    {
        $obj = self::find($id);
        $obj->fill($data);
        $obj->save();

        return true;
    }

    public static function remove(int $id): void
    {
        self::where('user_id', $id)->delete();
    }

    public static function soft_delete(int $id): void
    {
        self::onlyTrashed()->where('user_id', $id)->first()->forceDelete();
    }

    public static function soft_recovery(int $id): void
    {
        self::onlyTrashed()->where('user_id', $id)->first()->restore();
    }
}
