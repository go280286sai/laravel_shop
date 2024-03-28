<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Main;
use App\Models\Main_description;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $mains = Main::all();

        return view('client.admin.main_categories.index', ['mains' => $mains]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('client.admin.main_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainCategoryRequest $request): RedirectResponse
    {
        Main::add($request->validated());

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
        $main = Main_description::join('mains', 'main_descriptions.main_id', '=', 'mains.id')
            ->select(['mains.id', 'main_descriptions.title'])
            ->where('main_id', $id)
            ->get();

        return view('/client/admin/main_categories/edit', ['main' => $main]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MainCategoryRequest $request, string $id): RedirectResponse
    {
        Main_description::set_update($request->validated(), $id);

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        Main::remove($id);

        return Redirect::back();
    }
}
