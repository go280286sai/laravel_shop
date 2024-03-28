@extends('client.layouts.layout')

@section('content')
    <div class="container">

        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>id</th>
                <th>{{__('messages.name')}}</th>
                <th>{{__('messages.status')}}</th>
                <th>{{__('messages.description')}}</th>
                <th>{{__('messages.sum')}}</th>
                <th>{{__('messages.quantity')}}</th>
                <th>{{__('messages.created')}}</th>
                <th>{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>
                        {{$order->id}}
                    </td>
                        <td><a href="{{env('APP_URL')}}/admin/users/{{$order->user->id}}">{{$order->user->name}}</a></td>
                        <td>{{\App\Models\Order_status_description::where('order_status_id', $order->status_id)->first()->title}}</td>
                        <td>{{substr($order->notes, 0, 50) }}</td>
                        <td>{{$order->total}}</td>
                        <td>{{$order->qty}}</td>
                        <td>{{$order->created_at}}</td>
                    <td>
                        <table>
                            <tr>
                                <td><a href="{{env('APP_URL')}}/admin/orders/{{$order->id}}/edit" class="btn" title="{{__('messages.edit')}}">
                                        <i class="fa fa-search"></i></a>
                                </td>
                                <td>
                                    <form action="{{env('APP_URL')}}/admin/orders/{{$order->id}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('{{__('messages.are_you_sure')}}')" class="btn"
                                                title="{{__('messages.remove')}}"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </table>
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
