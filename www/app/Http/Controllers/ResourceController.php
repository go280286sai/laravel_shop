<?php

namespace App\Http\Controllers;

use App\Models\Resource_product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ResourceController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        $resources = Resource_product::all();

        return view('client.admin.resources.index', ['resources' => $resources]);
    }


    /**
     * @return View
     */
    public function create(): View
    {
        return view('client.admin.resources.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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
     * @param string $id
     * @return View
     */
    public function edit(string $id): View
    {
        $resource = Resource_product::find($id);

        return view('client.admin.resources.edit', ['resource' => $resource]);
    }


    /**
     * @param Request $request
     * @param string $id
     * @return RedirectResponse
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
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        Resource_product::find($id)->delete();

        return redirect()->route("admin.resources.index");
    }
}
