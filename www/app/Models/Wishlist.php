<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Wishlist extends Model
{
    use HasFactory;

    /**
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function add(int $id): true
    {
        $wishlists_array = [];
        $wishlists_array[] = Product::find($id);
        if (! Session::has('wishlist')) {
            Session::put('wishlist', $wishlists_array);

            return true;
        }
        $wishlists = Session::get('wishlist');
        foreach ($wishlists as $wishlist) {
            if ($wishlist->id == $id) {
                return true;
            }
        }
        $wishlists[] = $wishlists_array[0];
        Session::put('wishlist', $wishlists);

        return true;
    }

    /**
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function remove(int $id): bool
    {
        if (! Session::has('wishlist')) {
            return false;
        }
        $wishlists = Session::get('wishlist');
        $filteredArray = array_filter($wishlists, function ($item) use ($id) {
            return $item['id'] !== $id;
        });
        $updatedArray = array_values($filteredArray);
        Session::put('wishlist', $updatedArray);

        return true;
    }
}
