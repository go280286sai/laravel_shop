<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUpdateRequest;
use App\Http\Requests\DeliveryRequest;
use App\Models\Delivery;
use App\Models\Language;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Get all entries from cart given language selection
     *
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function getAll(): JsonResponse
    {
        Product::translate();

        return Response::json(Session::get('cart'));
    }

    /**
     * Add to cart
     *
     * @throws Exception
     *
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function add(AddUpdateRequest $request): JsonResponse
    {
        $fields = $request->validated();
        $id = $fields['id'];
        $qty = $fields['qty'];
        $product = Product::add_to_cart($id, $qty);
        if (! $product) {
            throw new Exception('Product not found');
        }

        return Response::json(['status' => true]);
    }

    /**
     * Remove from cart
     *
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function remove(Request $request): JsonResponse
    {
        $request->validate(
            ['id' => 'required|numeric']
        );
        $id = $request->input('id');
        Product::removeCart($id);

        return Response::json(['status' => true]);
    }

    /**
     * Update cart
     *
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function update(AddUpdateRequest $request): JsonResponse
    {
        $fields = $request->validated();
        $id = $fields['id'];
        $qty = $fields['qty'];
        Product::updateCart($id, $qty);

        return Response::json(['status' => true]);

    }

    /**
     * Remove all items from cart
     * Remove session cart
     *
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function clear(): RedirectResponse
    {
        Product::clear();

        return redirect()->route('home');
    }

    public function store(): View|RedirectResponse
    {
        if (Session::has('cart') && count(Session::get('cart')) > 0) {
            $carts = Session::get('cart');
            $lang = Language::getStatus();

            return view('cart.index', ['carts' => $carts, 'lang' => $lang]);
        }

        return Redirect::route('home');
    }

    /**
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function create(Request $request): RedirectResponse
    {
        $request->validate(
            ['payment' => 'required|digits_between:1,5']);
        if (Session::has('cart') && count(Session::get('cart')) > 0
            && Auth::check() && Session::has('delivery') && count(Session::get('delivery')) > 0
            && Session::has('order') && count(Session::get('order')) > 0) {
            $carts = Session::get('cart');
            $delivery = Session::get('delivery');
            $order = Session::get('order');
            $payment = $request->input('payment');
            try {
                $order_id = Order::add([
                    'user_id' => Auth::user()->id,
                    'notes' => json_encode($delivery),
                    'total' => $order['total_sum'],
                    'qty' => $order['total_count']]
                );
                foreach ($carts as $item) {
                    Order_product::add([
                        'order_id' => $order_id,
                        'product_id' => $item['id'],
                        'payment_id' => $payment,
                        'delivery_id' => $delivery['service'],
                        'title' => $item['title'],
                        'slug' => $item['slug'],
                        'qty' => $item['qty'],
                        'price' => $item['price'],
                        'sum' => $item['qty'] * $item['price'],
                    ]);
                }
                DB::commit();
                Session::remove('cart');
                Session::remove('delivery');
                Session::remove('order');
            } catch (Exception $e) {
                DB::rollback();
            }
        }

        return Redirect::route('home');
    }

    /**
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function delivery(Request $request): RedirectResponse|View
    {
        $request->validate(
            ['id' => 'nullable|digits_between:1,5']
        );
        $delivery = $request->input('id');
        if (Session::has('cart') && count(Session::get('cart')) > 0) {
            $carts = Session::get('cart');
            $lang = Language::getStatus();
            $user = Auth::user();

            return view('cart.delivery',
                [
                    'carts' => $carts,
                    'lang' => $lang,
                    'delivery' => $delivery,
                    'user' => $user,
                ]);
        }

        return Redirect::route('home');
    }

    /**
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function agreement(DeliveryRequest $request): RedirectResponse|View
    {
        $delivery = $request->validated();
        $lang = Language::getStatus();
        if (Session::has('cart') && count(Session::get('cart')) > 0) {

            $carts = Session::get('cart');
            $service = Delivery::find($delivery['service']);
            Session::put('delivery', $delivery);

            return view('cart.agreement', [
                'delivery' => $delivery,
                'lang' => $lang,
                'carts' => $carts,
                'service' => $service,
            ]);
        }

        return Redirect::route('home');
    }

    /**
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function order(Request $request): View
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'total_count' => 'required|numeric',
                'total_sum' => 'required|numeric',
            ]);
            $order = $request->only(['total_count', 'total_sum']);
            $id = 2;
            Session::put('order', $order);

        } else {
            $request->validate([
                'id' => 'required|digits_between:1,10',
            ]);
            $id = $request->input('id');
            $order = Session::get('order');
        }

        return view('cart.order', ['id' => $id, 'order' => $order]);
    }
}
