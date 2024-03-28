<?php

namespace App\Http\Controllers;

use App\Actions\ActionCreateCartClass;
use App\Http\Requests\DeliveryRequest;
use App\Models\Delivery;
use App\Models\Language;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * @return View|RedirectResponse
     */
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
        $validated = $request->validate(
            ['payment' => 'required|digits_between:1,5']);

        $payment = $validated['payment'];

        ActionCreateCartClass::create($payment);

        return Redirect::route('home');
    }

    /**
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public function delivery(Request $request): RedirectResponse|View
    {
        $validated = $request->validate(
            ['id' => 'nullable|digits_between:1,5']
        );

        $id = $validated['id'] ?? 1;
        $carts = Session::get('cart');
        $lang = Language::getStatus();
        $user = Auth::user();
        if (Session::has('cart') && count(Session::get('cart')) > 0) {

            return view('cart.delivery',
                [
                    'id' => $id,
                    'carts' => $carts,
                    'lang' => $lang,
                    'user' => $user
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
    public function order(Request $request, $id = 2): View
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'total_count' => 'required|numeric',
                'total_sum' => 'required|numeric',
            ]);

            $order = $request->only(['total_count', 'total_sum']);

            Session::put('order', $order);

        } else {
            $validated = $request->validate([
                'id' => 'required|digits_between:1,10',
            ]);

            $id = $validated['id'];
            $order = Session::get('order');
        }

        return view('cart.order', ['id' => $id, 'order' => $order]);
    }
}
