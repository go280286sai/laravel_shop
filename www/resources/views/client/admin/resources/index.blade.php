@extends('client.layouts.layout')

@section('content')
    <div class="container">
        <div class="btn_create">
            <a href="{{env('APP_URL')}}/admin/resources/create">
                <div class="btn btn-primary">{{__('messages.add')}}</div>
            </a>
        </div>
        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>{{__('messages.name')}}</th>
                <th>Url</th>
                <th>{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($resources as $resource)
                <tr>
                    <td>
                        {{$resource->name}}
                    </td>
                    <td>
                        {{$resource->url}}
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td><a href="{{env('APP_URL')}}/admin/resources/{{$resource->id}}/edit" class="btn"
                                       title="{{__('messages.edit')}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{env('APP_URL')}}/admin/resources/{{$resource->id}}" method="post">
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
