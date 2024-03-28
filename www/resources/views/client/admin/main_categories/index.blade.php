@extends('client.layouts.layout')

@section('content')
    <div class="container">
        <div class="btn_create">
            <a href="/admin/main_categories/create" ><div class="btn btn-primary">{{__('messages.add')}}</div></a>
        </div>

        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>id</th>
                <th><img src="{{env('APP_URL')}}/assets/img/en.png" alt="Ukraine"/></th>
                <th><img src="{{env('APP_URL')}}/assets/img/uk.png" alt="Ukraine"/></th>
                <th><img src="{{env('APP_URL')}}/assets/img/ru.png" alt="Ukraine"/></th>
                <th>{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($mains as $main)
                <tr>
                    <td>
                        {{$main->id}}
                    </td>
                    @foreach($main->main_descriptions as $main_description)
                        <td>{{$main_description->title}}</td>
                    @endforeach
                    <td>
                        <table>
                            <tr>
                                <td><a href="/admin/main_categories/{{$main->id}}/edit" class="btn"
                                       title="{{__('messages.edit')}}"><i class="fa fa-edit"></i></a>
                                </td>
                                <td>
                                    <form action="/admin/main_categories/{{$main->id}}" method="post">
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
