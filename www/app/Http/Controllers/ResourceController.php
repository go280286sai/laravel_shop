<?php

namespace App\Http\Controllers;

use App\Models\Resource_product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $resources = Resource_product::all();

        return view('client.admin.resources.index', ['resources' => $resources]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.admin.resources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'url' => ['required', 'string', 'url'],
        ]);
        Resource_product::add($validated);

        return redirect()->route("admin.resources.index");
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
    public function edit(string $id)
    {
        $resource = Resource_product::find($id);

        return view('client.admin.resources.edit', ['resource' => $resource]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'url' => ['required', 'string', 'url'],
        ]);
        Resource_product::find($id)->update($validated);

        return redirect()->route("admin.resources.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Resource_product::find($id)->delete();

        return redirect()->route("admin.resources.index");
    }
}
