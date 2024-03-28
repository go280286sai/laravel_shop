<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery_description;
use App\Models\Language;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Order_status;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $orders = Order::all();

        return view('client.admin.orders.index', ['orders' => $orders]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $order = Order::find($id);
        $client = json_decode($order->notes);
        $service = Delivery_description::where('delivery_id', $client->service)
            ->where('language_id', Language::getStatus()->id)
            ->first();
        $products = Order_product::where('order_id', $id)->get();

        return view('client.admin.orders.view',
            [
                'order' => $order,
                'client' => $client,
                'service' => $service,
                'products' => $products,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $order = Order::find($id);
        $statuses = Order_status::join('order_status_descriptions', 'order_status_descriptions.order_status_id',
            '=', 'order_statuses.id')
            ->where('order_status_descriptions.language_id', '=', Language::getStatus()->id)
            ->get();
        $products = Order_product::where('order_id', $order->id)->get();
        $client = json_decode($order->notes);
        $service = Delivery_description::where('delivery_id', $client->service)
            ->where('language_id', Language::getStatus()->id)
            ->first();

        return view('client.admin.orders.edit',
            [
                'order' => $order,
                'statuses' => $statuses,
                'products' => $products,
                'client' => $client,
                'service' => $service,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate(
            [
                'status' => 'required|numeric',
            ]
        );
        $data = $request->all();
        if ($data['status'] == 3 && ! isset($data['delivery_number']) && is_null($data['delivery_number'])) {
            return Redirect::back()->withErrors(['delivery_number' => 'Введите номер накладной']);
        }
        Order::update_status($data, $id);

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        Order::remove($id);

        return Redirect::back();
    }
}
