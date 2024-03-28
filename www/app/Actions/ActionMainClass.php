<?php

namespace App\Actions;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ActionMainClass
{

    /**
     * @param int $limit
     * @return object
     */
    public static function get_hits(int $limit): object
    {
        return Product::where('hit', '>', 0)
            ->orderBy('hit', 'DESC')
            ->limit($limit)
            ->get();
    }
}
