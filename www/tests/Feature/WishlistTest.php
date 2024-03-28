<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class WishlistTest extends TestCase
{
    public static function additionProvider(): array
    {
        //Checking the additions to the cart
        return [

            [1], [2], [3], [4], [4], [3], [2], [1],

        ];
    }

    /**
     * A basic feature test example.
     *
     * @dataProvider additionProvider
     */
    public function test_wishlist_add($id): void
    {
        $wishlists_array = [];
        $wishlists_array[] = Product::find($id);
        $this->assertEmpty(! $wishlists_array);
        if (! Session::has('wishlist')) {
            Session::put('wishlist', $wishlists_array);
            $this->assertTrue(Session::has('wishlist'));

            return;
        }
        $wishlists = Session::get('wishlist');
        $this->assertNotEmpty($wishlists);
        foreach ($wishlists as $wishlist) {
            if ($wishlist->id == $id) {
                return;
            }
        }
        $wishlists[] = $wishlists_array[0];
        Session::put('wishlist', $wishlists);
    }

    public function test_wishlist_add_result(): void
    {
        $test_array = [1, 2, 3, 4, 4, 3, 2, 1];
        $count = 4;
        foreach ($test_array as $item) {
            Wishlist::add($item);
        }
        $obj = Session::get('wishlist');
        $this->assertCount($count, $obj);
    }

    public function test_wishlist_remove(): void
    {
        $id = 1;
        $this->assertFalse(Session::has('wishlist'));
        if (! Session::has('wishlist')) {
            return;
        }
        Wishlist::add(1);
        $wishlists = Session::get('wishlist');
        $this->assertEmpty(! $wishlists);
        $filteredArray = array_filter($wishlists, function ($item) use ($id) {
            return $item['id'] !== $id;
        });
        $updatedArray = array_values($filteredArray);
        Session::put('wishlist', $updatedArray);
        $this->assertEmpty(Session::get('wishlist'));

    }

    public function test_wishlist_remove_result(): void
    {
        $test_array = [1, 2, 3, 4, 5, 6, 7, 8];
        $count = 4;
        foreach ($test_array as $item) {
            Wishlist::add($item);
        }
        for ($i = 5; $i <= 8; $i++) {
            Wishlist::remove($i);
        }
        $obj = Session::get('wishlist');
        $this->assertCount($count, $obj);
    }
}
