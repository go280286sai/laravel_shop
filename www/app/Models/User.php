<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @return HasOne
     */
    public function user_comments(): HasOne
    {
        return $this->hasOne(User_comment::class);
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return HasMany
     */
    public function user_descriptions(): HasMany
    {
        return $this->hasMany(User_description::class);
    }

    /**
     * @param int $id
     * @param array $data
     * @return true
     */
    public static function set_update(int $id, array $data): true
    {
        $obj = self::find($id);
        $obj->fill($data);

        if (!is_null($data['new_password'])) {
            $obj->password = Hash::make($data['new_password']);
        }

        $obj->save();

        return true;
    }

    /**
     * @return bool
     */
    public static function is_admin(): bool
    {
        $admin = self::find(Auth::user()->id);

        if ($admin->is_admin) {
            return true;
        }

        return false;
    }

    /**
     * @param int $id
     * @return void
     */
    public static function status(int $id): void
    {
        $obj = self::find($id);
        $obj->status = $obj->status == 1?0 : 1;
        $obj->save();
    }

    /**
     * @param int $id
     * @return void
     */
    public static function remove(int $id): void
    {
        try {
            DB::beginTransaction();

            $obj = self::find($id);

            User_description::remove($id);

            $obj->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * @param $id
     * @return void
     */
    public static function soft_remove($id): void
    {
        try {
            DB::beginTransaction();

            $obj = self::onlyTrashed()->where('id', $id)->first();

            User_description::soft_delete($id);
            $obj->forceDelete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * @param $id
     * @return void
     */
    public static function soft_recovery($id): void
    {

        try {
            DB::beginTransaction();

            $obj = self::onlyTrashed()->find($id);
            User_description::soft_recovery($id);
            $obj->restore();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}
