@extends('client.layouts.layout')

@section('content')
    <div class="container">

        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>{{__('messages.status')}}</th>
                <th>{{__('messages.description')}}</th>
                <th>{{__('messages.sum')}}</th>
                <th>{{__('messages.quantity')}}</th>
                <th>{{__('messages.created')}}</th>
                <th>{{__('messages.view')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td><b>{{\App\Models\Order_status_description::where('order_status_id', $order->status_id)
                         ->where('language_id', \App\Models\Language::getStatus()->id)
                         ->first()->title}}</b> </td>
                    <td>
                            <?php
                            $obj = json_decode($order->notes);
                            echo '<b>'.__("messages.first_last_name").'</b>: ' . $obj->last_name . ' ' . $obj->name . '<br>';
                            echo '<b>'.__("messages.phone").'</b>: ' . $obj->phone . '<br>';
                            echo '<b>'.__("messages.delivery").'</b>: '. \App\Models\Delivery_description::where('delivery_id', $obj->service)
                                    ->where('language_id', \App\Models\Language::getStatus()->id)
                                    ->get('title')[0]->title;
                            if (isset($obj->delivery_number)) {
                                echo '<b>'.__("messages.delivery_number").'</b>: ' . $obj->delivery_number;
                            }
                            ?>
                    </td>
                    <td>{{$order->total}}</td>
                    <td>{{$order->qty}}</td>
                    <td>{{ \Illuminate\Support\Carbon::make($order->created_at)->format('d.m.Y')}}</td>
                    <td>
                        <a href="{{env('APP_URL')}}/client/orders/{{$order->id}}/view" class="btn"
                           title="{{__('messages.view')}}">
                            <i class="fa fa-search"></i></a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#example');
    </script>
@endsection
