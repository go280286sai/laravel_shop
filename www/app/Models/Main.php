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

    public function main_descriptions(): HasMany
    {
        return $this->hasMany(Main_description::class);
    }

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
        } else {
            $list = self::all();
            Cache::put('list', $list);
        }

        return $list;
    }

    /**
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function get_title(int $id): ?string
    {
        $obj = self::find($id);
        foreach ($obj->main_descriptions as $main_description) {
            if ($main_description->language_id == Language::getStatus()->id) {
                return $main_description->title;
            }
        }

        return null;
    }

    public static function remove(int $id): void
    {
        self::find($id)->delete();
    }

    public static function add(array $data): void
    {
        $obj = new self();
        $obj->save();
        $data['main_id'] = $obj->id;
        Main_description::add($data);
    }
}
