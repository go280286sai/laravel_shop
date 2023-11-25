@extends('client.layouts.layout')

@section('content')

<div id="printableArea">
    <div class="container">
        <div class="row">
            <h5>{{__('messages.created_order').': '. \Illuminate\Support\Carbon::make($order->created_at)->format('d.m.Y')}}</h5>
        </div>
        <div class="mb-3">
            <table class="table table-bordered">
                <tr>
                    <td>{{__('messages.first_last_name')}}</td>
                    <td>{{$client->name. ' '. $client->last_name}}</td>
                </tr>
                <tr>
                    <td>{{__('messages.phone')}}</td>
                    <td>{{$client->phone}}</td>
                </tr>
                <tr>
                    <td>{{__('messages.delivery')}}</td>
                    <td>{{$service->title}}</td>
                </tr>
                <tr>
                    <td>{{__('messages.delivery_address')}}</td>
                    <td>{{$client->city.', '. $client->street}}</td>
                </tr>
                @if(isset($client->delivery_number))
                    <tr>
                        <td>{{__('messages.delivery_number').' '.\Illuminate\Support\Carbon::make($order->updated_at)
                             ->format('d.m.Y')}}</td>
                        <td>{{$client->delivery_number}}</td>
                    </tr>
                @endif
            </table>
        </div>
        <div class="mb-3">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        {{__('messages.product')}}
                    </th>
                    <th>
                        {{__('messages.price')}}
                    </th>
                    <th>
                        {{__('messages.quantity')}}
                    </th>
                    <th>
                        {{__('messages.sum')}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->title}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->qty}}</td>
                        <td>{{$product->price*$product->qty}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mb-3 no_print">
            <a href="{{env('APP_URL').'/client/orders/'}}" title="{{__('messages.to_back')}}">
                <div class="btn btn-danger"><-----</div>
            </a>

        </div>
    </div>

</div>
@endsection




