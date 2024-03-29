<?php

namespace App\Http\Controllers\Admin;

use App\Actions\GetParseDataClass;
use App\Http\Controllers\Controller;
use App\Models\Resource_product;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class ExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('client.admin.exchange.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'target' => ['required', 'string', 'max:255', Rule::notIn(['null'])],
            'resource' => ['required', 'string', 'max:255', Rule::notIn(['null'])],
            'url' => ['required', 'string', 'max:255'],
        ]);
        $token = $this->get_token($request);
        try {
            Http::asForm()->post($validated['resource'], [
                'target' => $validated['target'],
                'url' => $validated['url'],
                'token' => $token
            ]);

            return redirect()->route('admin.exchanges.index')->with('status', 'Exchange created successfully!');
        } catch (Exception) {
            return redirect()->route('admin.exchanges.index')->with('error', 'Something went wrong.');
        }

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * @param Request $request
     * @return string
     */
    public function get_token(Request $request): string
    {
        foreach ($request->user()->tokens as $token) {
            $token->delete();
        }
        $token = $request->user()->createToken($request->user()->name);
        return $token->plainTextToken;
    }
}
