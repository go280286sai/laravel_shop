<link rel="stylesheet" href="{{env('APP_URL')}}/assets/bootstrap/css/bootstrap.min.css">
<style>
    /* Стили для печати */
    @media print {
        /* Скрыть все элементы, кроме блока с id "printableArea" */
        .no_print {
            display: none;
        }

        #printableArea {
            display: block;
        }
    }
</style>
<body>
<div id="printableArea">
    <div class="container">
        <div class="row">
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
        <div class="mb3">
            <table class="table">
                <tr>
                    <td>__________________________________________</td>
                    <td>_____________________</td>
                </tr>
            </table>
        </div>
        <div class="mb-3 no_print">
            <a href="{{env('APP_URL').'/admin/orders/'.$order->id.'/edit'}}" title="{{__('messages.to_back')}}">
                <div class="btn btn-danger"><-----</div>
            </a>
            <div class="btn btn-primary" id="printButton" onclick=" window.print()">{{__('messages.print')}}</div>

        </div>
    </div>

</div>


</body>




