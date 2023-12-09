<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Main_description extends Model
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
     * @return BelongsTo
     */
    public function languages(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public static function getDescription(int $id): mixed
    {
        return self::where('main_id', $id)->where('language_id', Language::getStatus()->id)->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function get_title(int $id): mixed
    {
        return self::find($id)->title;
    }

    /**
     * @param array $data
     * @param int $id
     * @return void
     */
    public static function set_update(array $data, int $id): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $obj = self::all()->where('main_id', $id)->where('language_id', $i)->first();
            $obj->title = $data['main_description_' . $i];
            $obj->save();
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public static function add(array $data): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $obj = new self();
            $obj->main_id = $data['main_id'];
            $obj->language_id = $i;
            $obj->title = $data['main_description_' . $i];
            $obj->save();
        }
    }
}
