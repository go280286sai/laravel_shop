<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CartTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_cart(): void
    {
        //Checked for a session
        $this->assertFalse(Session::has('cart'));
        //Added product 1 with id 1
        Product::add_to_cart(1, 1);
        //Checked for a session
        $this->assertTrue(Session::has('cart'));
        //Checked for product 1
        $this->assertEquals(1, Session::get('cart')[0]->qty);
        //Added product 2 with id 1
        Product::add_to_cart(1, 2);
        //Checked for the summation of the same product
        $this->assertEquals(3, Session::get('cart')[0]->qty);
        //Added product 3 with id 1
        Product::add_to_cart(1, 3);
        //Checked for the summation of the same product
        $this->assertEquals(6, Session::get('cart')[0]->qty);
        //Updated the quantity of item 9 with id 1
        Product::updateCart(1, 9);
        //Checked for product update
        $this->assertEquals(9, Session::get('cart')[0]->qty);
        //Updated the quantity of item 20 with id 1
        Product::updateCart(1, 20);
        //Checked for updating the product, taking into account the maximum specified quantity of 10
        $this->assertEquals(10, Session::get('cart')[0]->qty);
        //Deleted product 1
        Product::removeCart(1);
        //Checked for deletion
        $this->assertEmpty(Session::get('cart'));
        //Removed all products
        product::clear();
        //Checked for deletion
        $this->assertFalse(Session::has('cart'));
    }
}
