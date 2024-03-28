<?php

namespace Tests\Feature;

use App\Models\Language;
use App\Models\Product;
use App\Models\Product_description;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BroadTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $id = 67;
        $start = microtime(true);
        $product = Product::find($id);
        $description = Product_description::where('product_id', $id)->where('language_id', Language::getStatus()->id)->first();
        print_r($product);
        print_r($description);
        $time = microtime(true) - $start;
        echo $time.PHP_EOL;
        $start2 = microtime(true);
        $total = DB::table('products')->join('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
            ->select('products.*', 'product_descriptions.title')
            ->where('products.id', $id)
            ->first();

        print_r($total);
        $time2 = microtime(true) - $start2;
        echo $time2.PHP_EOL;
        $this->assertTrue(true);
        $this->assertTrue($time2 <= $time);
        echo $time - $time2;
    }
}
