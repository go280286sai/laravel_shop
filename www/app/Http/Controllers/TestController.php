<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    public function index()
    {
        $product = Session::get('cart');
        $prod = DB::table("products")
            ->join("product_descriptions", "products.id", "=", "product_descriptions.product_id")
            ->select("products.*", "product_descriptions.title")
            ->where("product_descriptions.language_id", Language::getStatus()->id)
            ->where('products.id', 1)
            ->first();
        dd($prod);
    }
}
