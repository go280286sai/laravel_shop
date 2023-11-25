@extends('client.layouts.layout')

@section('content')
    <div class="container">
        @include('layouts.errors')
        <form action="{{env('APP_URL')}}/admin/orders/{{$order->id}}" method="post">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <h5>{{__('messages.created_order').': '. $order->created_at}}</h5>
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

            <div class="mb-3">
                <label for="qty" class="form-label">{{__('messages.quantity')}}</label>
                <input type="text" name="qty" class="form-control"
                       id="qty" aria-describedby="emailHelp" value="{{$order->qty}}" disabled="disabled">
            </div>

            <div class="mb-3">
                <label for="total" class="form-label">{{__('messages.total')}}</label>
                <input type="text" name="total" class="form-control"
                       id="notes" aria-describedby="emailHelp" value="{{$order->total}}" disabled="disabled">
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">{{__('messages.edit_status')}}</label>
                <select name="status" id="select_category" class="form-select mb-3" aria-label="Default select example">
                    @foreach($statuses as $status)
                        @if($status->order_status_id == $order->status_id)
                            <option selected value="{{$status->order_status_id}}">{{$status->title}}</option>
                        @endif
                        <option value="{{$status->order_status_id}}">{{$status->title}}</option>
                    @endforeach
                </select></div>
            @if($order->status_id == 2)
                <label for="delivery_number" class="form-label">{{__('messages.input_delivery_number')}}</label>
                <input type="text" name="delivery_number" id="delivery_number" class="form-control mb-3"
                       placeholder="{{__('messages.input_delivery_number')}}">
            @endif
            <table>
                <tr>
                    <td>
                        <button type="submit" class="btn btn-primary">{{__('messages.update')}}</button>
                    </td>
                    <td><a href="{{env('APP_URL')}}/admin/orders/{{$order->id}}">
                            <div class="btn btn-success">{{__('messages.create_document')}}</div>
                        </a></td>
                </tr>
            </table>
        </form>
        <br>
        <a href="{{env('APP_URL')}}/admin/orders" title="{{__('messages.to_back')}}">
            <div class="btn btn-danger"><-----</div>
        </a>
        <a href="{{env('APP_URL').'/admin/users/'.$order->user->id.'/edit'}}" title="{{__('messages.view_user')}}">
            <div class="btn btn-danger">{{__('messages.view_user')}}</div>
        </a>

    </div>

@endsection

@section('js')
@endsection
