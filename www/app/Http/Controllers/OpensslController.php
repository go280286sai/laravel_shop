<?php

namespace App\Http\Controllers;

use go280286sai\laravel_openssl\Models\Ssl_search;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OpensslController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $resource = Ssl_search::all();

        return view('vendor.openssl.index', ['resource' => $resource]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('vendor.openssl.add_resource');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'key' => 'required|string',
            'url' => 'required|string',
        ]);

        Ssl_search::add_resource(['name' => $validated['name'], 'key' => $validated['key'], 'url' => $validated['url']]);

        return redirect()->back();
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
        $resource = Ssl_search::find($id);
        $publicKey = Ssl_search::get_public_key($id . Ssl_search::$toSave);

        return view('vendor.openssl.update_resource', ['resource' => $resource, 'publicKey' => $publicKey]);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'key' => 'required|string',
            'url' => 'required|string',
        ]);
        Ssl_search::update_resource(
            [
                'name' => $validated['name'], 'key' => $validated['key'], 'url' => $validated['url'],
            ], $id);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        Ssl_search::remove($id);

        return redirect()->back();
    }
}
