<?php

namespace App\Actions;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ActionMainClass
{
    public static function get_hits(int $limit): object
    {
        if (Cache::has('hit')) {
            return Cache::get('hit');
        } else {
            $hit = Product::where('hit', '>', 0)
                ->orderBy('hit', 'DESC')
                ->limit($limit)
                ->get();
            Cache::put('hit', $hit);
        }

        return $hit;
    }
}
