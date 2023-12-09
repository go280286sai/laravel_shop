<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Delivery_description;
use App\Models\Language;
use App\Models\Order;
use App\Models\Order_product;
use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();

        return view('client.user.orders.index', ['orders' => $orders]);
    }

    /**
     * @param int $id
     * @return View
     */
    public function view(int $id): View
    {
        $order = Order::find($id)->where('user_id', auth()->user()->id)->first();
        $client = json_decode($order->notes);
        $service = Delivery_description::where('delivery_id', $client->service)
            ->where('language_id', Language::getStatus()->id)
            ->first();
        $products = Order_product::where('order_id', $id)->get();

        return view('client.user.orders.view',
            [
                'order' => $order,
                'client' => $client,
                'service' => $service,
                'products' => $products,
            ]);
    }
}
