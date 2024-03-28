<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Category_description;
use App\Models\Language;
use App\Models\Main_description;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $mains = Main_description::join('mains', 'main_descriptions.main_id', '=', 'mains.id')
            ->where('language_id', Language::getStatus()->id)->get();
        $categories = Category_description::join('categories', 'category_descriptions.category_id', '=', 'categories.id')
            ->where('language_id', Language::getStatus()->id)->get();

        return view('client.admin.categories.index',
            [
                'mains' => $mains,
                'categories' => $categories,
                'lang' => Language::getStatus(),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $mains = Main_description::join('mains', 'main_descriptions.main_id', '=', 'mains.id')
            ->where('language_id', Language::getStatus()->id)
            ->get();

        return view('client.admin.categories.create', ['mains' => $mains]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::add($request->validated());

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
        $mains = Main_description::join('mains', 'main_descriptions.main_id', '=', 'mains.id')
            ->where('language_id', Language::getStatus()->id)
            ->get();
        $categories = Category_description::join('categories', 'category_descriptions.category_id', '=', 'categories.id')
            ->where('category_descriptions.category_id', '=', $id)
            ->get();

        return view('client.admin.categories.edit',
            [
                'categories' => $categories,
                'mains' => $mains,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();
        Category::set_update($id, $data['main']);
        Category_description::set_update($data, $id);

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Category::remove($id);

        return Redirect::back();
    }
}
