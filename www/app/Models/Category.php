<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function mains(): BelongsTo
    {
        return $this->belongsTo(Main::class);
    }

    /**
     * @return HasMany
     */
    public function category_descriptions(): HasMany
    {
        return $this->hasMany(Category_description::class);
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @param int $id
     * @return object
     */
    public static function get(int $id): object
    {
        return self::find($id);
    }

    /**
     * @param int $id
     * @return void
     */
    public static function remove(int $id): void
    {
        self::find($id)->delete();
    }

    /**
     * @param array $data
     * @return int
     */
    public static function add(array $data): int
    {
        $obj = new self();
        $obj->main_id = $data['main'];
        $obj->save();
        $data['category_id'] = $obj->id;
        Category_description::add($data);
        return $obj->id;
    }

    /**
     * @param int $id
     * @param int $value
     * @return void
     */
    public static function set_update(int $id, int $value): void
    {
        $obj = self::find($id);
        $obj->main_id = $value;
        $obj->save();
    }
}
