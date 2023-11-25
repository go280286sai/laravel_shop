<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category_description extends Model
{
    use HasFactory;

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function languages(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public static function set_update(array $data, int $id): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $obj = self::all()->where('category_id', $id)->where('language_id', $i)->first();
            $obj->title = $data['title_'.$i];
            $obj->description = $data['description_'.$i];
            $obj->keywords = $data['keywords_'.$i];
            $obj->content = $data['content_'.$i];
            $obj->save();
        }
    }

    public static function add(array $data): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $obj = new self();
            $obj->category_id = $data['category_id'];
            $obj->language_id = $i;
            $obj->title = $data['title_'.$i];
            $obj->description = $data['description_'.$i];
            $obj->keywords = $data['keywords_'.$i];
            $obj->content = $data['content_'.$i];
            $obj->save();
        }
    }
}
