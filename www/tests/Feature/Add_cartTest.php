<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class Add_cartTest extends TestCase
{
    public static function additionProvider()
    {
        //Checking the additions to the cart
        return [
            [1, 1],
            [1, 1],
            [2, 30],
            [3, 1],
        ];
    }

    /**
     * A basic feature test example.
     *
     * @dataProvider additionProvider
     */
    public function test_addtocart($id, $qty): void
    {
        //Find the product
        $is_product = Product::find($id);
        //Check for availability
        $amount = $is_product->amount;
        //Compare the number of goods and the number in the cart
        $amount < $qty ? $qty = $amount : $qty;
        $this->assertFalse($amount < $qty);
        echo 'qty: '.$qty.' <= amount: '.$amount;
        //Check if there is a cart and that there is a product in it
        if (Session::has('cart') && Session::get('cart') != []) {
            echo 'has cart';
            $this->assertEquals(true, Session::has('cart'));
            $products = Session::get('cart');
            //Check if the product is in the cart
            foreach ($products as $product) {
                if ($product->id == $is_product->id) {
                    echo 'is product id: '.$is_product->id.' == product id: '.$product->id;
                    $this->assertEquals($product->id, $is_product->id);
                    //Determine the number of items that can be added to the cart
                    (($product->qty + $qty) <= $amount) ? $product->qty += $qty : $product->qty = $amount;
                    echo 'qty: '.$qty.' <= amount: '.$amount;
                    $this->assertTrue($product->qty <= $amount);
                    //Save the cart
                    Session::put('cart', $products);
                }
            }
            //Save to the cart if there is no product in it
            $is_product->qty = $qty;
            $products[] = $is_product;
            Session::put('cart', $products);
            echo 'add to cart';
        } else {
            //Create a cart and add a product
            $this->assertFalse(Session::has('cart'));
            $products = [];
            $is_product->qty = $qty;
            $products[] = $is_product;
            Session::put('cart', $products);
            $this->assertTrue(Session::has('cart'));
            echo 'add to cart';
        }
    }

    public function test_incart()
    {
        //Add 4 products
        for ($i = 0; $i < 3; $i++) {
            $qty = [1, 1, 30, 1];
            $id = [1, 1, 2, 3];
            $this->test_addtocart($id[$i], $qty[$i]);
        }
        //Check if there is a cart
        if (Session::has('cart')) {
            $result = Session::get('cart');
            $total = 0;
            $total_qty = 0;
            //Get the total number of items
            foreach ($result as $item) {
                $total++;
                $total_qty += $item['qty'];
            }
            $this->assertEquals(3, $total);
            $this->assertEquals(13, $total_qty);
        }
    }
}
