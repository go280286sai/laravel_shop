<?php

namespace App\Http\Controllers;

use App\Actions\MapPathClass;
use App\Models\Language;
use App\Models\Main;
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
    public function view(int $id): View
    {
        $product = Product::find($id);

        if ($product == null) {
            abort(404);
        }

        return view('products.product', [
            'id' => $id,
            'product' => $product,
            'lang' => Language::getStatus()->id,
        ]);
    }

    /**
     * Get selected category
     *
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function category(int $id): View
    {
        $products = Product_description::join('products', 'products.id', '=', 'product_descriptions.product_id')
            ->where('language_id', Language::getStatus()->id)
            ->where('products.status', 1)
            ->where('category_id', $id)
            ->paginate(6);

        $category = MapPathClass::path_category($id);

        return view('products.category', [
            'category' => $category,
            'id' => $id,
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
