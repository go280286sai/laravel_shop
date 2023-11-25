<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Main_description extends Model
{
    use HasFactory;

    public function mains(): BelongsTo
    {
        return $this->belongsTo(Main::class);
    }

    public function languages(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public static function getDescription(int $id): mixed
    {
        return self::where('main_id', $id)->where('language_id', Language::getStatus()->id)->get();
    }

    public function get_title(int $id): mixed
    {
        return self::find($id)->title;
    }

    public static function set_update(array $data, int $id): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $obj = self::all()->where('main_id', $id)->where('language_id', $i)->first();
            $obj->title = $data['main_description_'.$i];
            $obj->save();
        }
    }

    public static function add(array $data): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $obj = new self();
            $obj->main_id = $data['main_id'];
            $obj->language_id = $i;
            $obj->title = $data['main_description_'.$i];
            $obj->save();
        }
    }
}
