<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category_description;
use App\Models\Language;
use App\Models\Main_description;
use App\Models\Product;
use App\Models\Product_description;
use App\Models\Product_gallery;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $mains = Main_description::join('mains', 'main_descriptions.main_id', '=', 'mains.id')
            ->where('language_id', Language::getStatus()->id)
            ->get();
        $categories = Category_description::join('categories', 'category_descriptions.category_id', '=', 'categories.id')
            ->where('language_id', Language::getStatus()->id)
            ->get();
        $products = Product_description::join('products', 'product_descriptions.product_id', '=', 'products.id')
            ->where('language_id', Language::getStatus()->id)
            ->get();

        return view('client.admin.products.index', [
            'mains' => $mains,
            'categories' => $categories,
            'products' => $products,
            'lang' => Language::getStatus(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category_description::join('categories', 'category_descriptions.category_id', '=', 'categories.id')
            ->where('language_id', Language::getStatus()->id)
            ->get();

        return view('client.admin.products.create',
            [
                'categories' => $categories,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (isset($data['img'])) {
            $data['img'] = Storage::put('/uploads/img', $request->file('img'));
        }
        Product::add($data);

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $categories = Category_description::join('categories', 'category_descriptions.category_id', '=', 'categories.id')
            ->where('language_id', Language::getStatus()->id)
            ->get();
        $products = Product_description::join('products', 'product_descriptions.product_id', '=', 'products.id')
            ->select('*', 'product_descriptions.id as product_descriptions_id')
            ->where('product_descriptions.product_id', '=', $id)
            ->get();
        $galleries = Product_gallery::where('product_id', '=', $id)
            ->get();

        return view('client.admin.products.edit',
            [
                'galleries' => $galleries,
                'categories' => $categories,
                'products' => $products,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();
        if (isset($data['img'])) {
            $data['img'] = Storage::put('/uploads/img', $request->file('img'));
        }
        Product::set_update($data, $id);

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        Product::remove($id);

        return Redirect::back();
    }

    public function status(int $id): RedirectResponse
    {
        Product::toggle($id);

        return Redirect::back();
    }

    public function gallery(Request $request): RedirectResponse
    {
        $data = [];
        foreach ($request->file('gallery') as $key => $value) {
            $img = Storage::put('/uploads/products', $value);
            $data[$key] = $img;
        }
        Product_gallery::set_update($data);

        return Redirect::back();
    }

    public function add_gallery(Request $request): RedirectResponse
    {
        $file = $request->file('img');
        $img = Storage::put('/uploads/products', $file);
        Product_gallery::add($request->product_id, $img);

        return Redirect::back();
    }

    public function delete_gallery(int $id): RedirectResponse
    {
        Product_gallery::remove($id);

        return Redirect::back();
    }
}
