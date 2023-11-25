@extends('client.layouts.layout')

@section('content')
    <div class="container">
        <div class="btn_create">
            <a href="{{env('APP_URL')}}/admin/categories/create">
                <div class="btn btn-primary">{{__('messages.add')}}</div>
            </a>
        </div>
        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>{{__('messages.main_category')}}</th>
                <th><img src="{{env('APP_URL')}}/assets/img/{{$lang->code}}.png"
                         alt="{{$lang->title}}"/>&nbsp;{{__('messages.category')}}</th>
                <th>{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>
                        @foreach($mains as $main)
                            @if($main->id == $category->main_id)
                                {{$main->title}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        {{$category->title}}
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td><a href="{{env('APP_URL')}}/admin/categories/{{$category->id}}/edit" class="btn"
                                       title="{{__('messages.edit')}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{env('APP_URL')}}/admin/categories/{{$category->id}}" method="post">
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
