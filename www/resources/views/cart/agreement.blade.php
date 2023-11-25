@extends('layouts.layout')
@section('content')
<div class="container align-items-center">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <!-- Session Status -->
            <x-auth-session-status :status="session('status')"/>
            <form method="POST" action="/cart/order" class="form_login mt-2">
                @csrf
                <?php $total_price = 0; $total_count = 0 ?>
                <table class="table">
                    <thead>
                    <tr class="table-dark">
                        <th scope="col">{{__('messages.title')}}</th>
                        <th scope="col">{{__('messages.price')}}</th>
                        <th scope="col">{{__('messages.quantity')}}</th>
                        <th scope="col">{{__('messages.sum')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($carts as $cart)
                        <tr class="table-success">
                                <?php
                                $total_price += $cart->price * $cart->qty;
                                $total_count += $cart->qty;
                                ?>
                            <td>{{$cart->title}}</td>
                            <td>{{$cart->price}}</td>
                            <td>{{$cart->qty}}</td>
                            <td>{{$cart->price * $cart->qty}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                    <table class="table">
                        <tr class="table-dark">
                            <td>{{__("messages.all_products")}}</td>
                            <td><?= $total_count ?></td>
                        </tr>
                        <tr class="table-dark">
                            <td>{{__("messages.total")}}</td>
                            <td><?= $total_price ?></td>
                    </table>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label text_label">{{__('messages.name_last_name_recipient')}}</label>
                    <input class="form-control form_text" id="name" type="text" disabled="disabled"
                           value="{{$delivery['name']}} {{$delivery['last_name']}}">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label text_label">{{__('messages.delivery_service')}}</label>
                    <input class="form-control form_text" id="name" type="text" disabled="disabled"
                           value="{{$service->delivery_description[0]->title}}">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label text_label">{{__('messages.phone')}}</label>
                    <input class="form-control form_text" id="name" type="text" disabled="disabled"
                           value="{{$delivery['phone']}}">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label text_label">{{__('messages.delivery_address')}}</label>
                    <input class="form-control form_text" id="name" type="text" disabled="disabled"
                           value="{{$delivery['city']}} {{$delivery['street']}}">
                </div>
                {{__('messages.edit_to_back')}}

                <form action="/cart/order" method="post">
                    @csrf
                    <input type="hidden" name="total_sum" value="<?=$total_price?>">
                    <input type="hidden" name="total_count" value="<?=$total_count?>">
                    <input type="submit" class="btn btn-primary" value="{{__('messages.go_to_the_payment')}}">
                    <div class="mb-3">
                        <a href="/cart/delivery">
                            <div class="btn btn-danger ripple">{{__('messages.to_back')}}</div>
                        </a>
                    </div>
                </form>

            </form>

            <br><br>
        </div>
    </div>
</div>
@endsection
