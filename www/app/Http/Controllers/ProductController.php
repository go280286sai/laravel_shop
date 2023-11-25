<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Category_description;
use App\Models\Language;
use App\Models\Main;
use App\Models\Main_description;
use App\Models\Product;
use App\Models\Product_description;
use Illuminate\Contracts\View\View;


class ProductController extends Controller
{
    /**
     * Get selected product
     *
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function view(string $slug): View
    {
        $product = Product::where('id', $slug)->first();
        if ($product == null) {
            abort(404);
        }
        $path = Product::get_path_product($product->id);

        return view('products.product', [
            'product' => $product,
            'lang' => Language::getStatus()->id,
            'path' => $path,
        ]);
    }

    /**
     * Get selected category
     *
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function category(int $id): View
    {
        $category = Category_description::join('categories', 'categories.id', '=', 'category_descriptions.category_id')
        ->where('category_descriptions.language_id', Language::getStatus()->id)->where('categories.id', $id)->first();
        $main = Main_description::where('language_id', Language::getStatus()->id)
            ->where('main_id', $category->main_id)
            ->first();
        $products = Product_description::join('products', 'products.id', '=', 'product_descriptions.product_id')
            ->where('language_id', Language::getStatus()->id)
            ->where('products.status', 1)
            ->where('category_id', $id)
            ->paginate(6);

        return view('products.category', [
            'category' => $category,
            'main' => $main,
            'products' => $products,
        ]);
    }

    /**
     * Get main category
     *
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function parent(int $id): View
    {
        $lang = Language::getStatus()->id;
        $parent = Main::find($id);

        return view('products.parent', [
            'parent' => $parent,
            'lang' => $lang,
        ]);
    }
}
