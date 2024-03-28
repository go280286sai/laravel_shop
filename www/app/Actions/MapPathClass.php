<?php

namespace App\Actions;

use App\Models\Language;
use Illuminate\Support\Facades\DB;

class MapPathClass
{
    /**
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function path_category(int $id): object
    {
        $lang = Language::getStatus()->id;

        return DB::table('category_descriptions')
            ->join('categories', 'category_descriptions.category_id', '=', 'categories.id')
            ->join('main_descriptions', 'categories.main_id', '=', 'main_descriptions.main_id')
            ->where('category_id', $id)
            ->where('category_descriptions.language_id', $lang)
            ->where('main_descriptions.language_id', $lang)
            ->first(['category_descriptions.title as category_title', 'main_descriptions.title as main_title',
                'category_id', 'main_descriptions.main_id']);

    }
}
