<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\Order_product;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 *
 */
class ActionCreateCartClass
{
    /**
     * @param int $payment
     * @return void
     */
    public static function create(array $payments): void
    {
        if (Session::has('cart') && count(Session::get('cart')) > 0
            && Auth::check() && Session::has('delivery') && count(Session::get('delivery')) > 0
            && Session::has('order') && count(Session::get('order')) > 0) {
            $carts = Session::get('cart');
            $delivery = Session::get('delivery');
            $order = Session::get('order');

            try {
                DB::beginTransaction();
                $order_id = Order::add([
                    'user_id' => Auth::user()->id,
                    'notes' => json_encode($delivery),
                    'total' => $order['total_sum'],
                    'qty' => $order['total_count'],
                    'id_transaction' => $payments['id_transaction'],
                    'from'=>$payments['from'],
                    'hash'=>$payments['hash']
                    ]
                );
                foreach ($carts as $item) {
                    Order_product::add([
                        'order_id' => $order_id,
                        'product_id' => $item->id,
                        'payment_id' => $payments['payment'],
                        'delivery_id' => $delivery['service'],
                        'title' => $item->title,
                        'slug' => $item->slug,
                        'qty' => $item->qty,
                        'price' => $item->price,
                        'sum' => $item->qty * $item->price,
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
    }
}
