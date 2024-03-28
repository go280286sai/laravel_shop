<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Main extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function main_descriptions(): HasMany
    {
        return $this->hasMany(Main_description::class);
    }

    /**
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    /**
     * @return Collection|mixed
     *
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function list(): mixed
    {
        if (Cache::has('list')) {
            return Cache::get('list');
        }
        $list = self::all();
        Cache::put('list', $list);


        return $list;
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
        $obj->save();
        $data['main_id'] = $obj->id;
        Main_description::add($data);
        return $obj->id;
    }
}
