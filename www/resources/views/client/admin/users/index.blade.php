@extends('client.layouts.layout')

@section('content')
    <div class="container">
        <div class="btn_create">
            <a href="{{env('APP_URL')}}/admin/soft_deletes">
                <div class="btn btn-primary">{{__('messages.recovery').'/'.__('messages.remove')}}</div>
            </a>
        </div>
        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>{{__('messages.first_last_name')}}</th>
                <th>Email</th>
                <th>{{__('messages.phone')}}</th>
                <th>{{__('messages.status')}}</th>
                <th>{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <a href="{{env('APP_URL')}}/admin/users/{{$user->id}}/edit">{{$user->name.' '.$user->last_name}}</a>
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>{{$user->phone}}</td>
                    <td>
                        @if($user->status == 1)
                            <a href="{{env('APP_URL')}}/admin/users/status/{{$user->id}}" class="btn"
                               title="{{__('messages.active')}}"><i class="fa fa-unlock"></i></a>
                        @else
                            <a href="{{env('APP_URL')}}/admin/users/status/{{$user->id}}" class="btn"
                               title="{{__('messages.deactivate')}}"><i class="fa fa-lock"></i></a>
                        @endif
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td><a href="{{env('APP_URL')}}/admin/users/{{$user->id}}/edit" class="btn"
                                       title="{{__('messages.edit')}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{env('APP_URL')}}/admin/users/{{$user->id}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('{{__('messages.are_you_sure')}}')" class="btn"
                                                title="{{__('messages.remove')}}"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="{{env('APP_URL').'/admin/user/comment/'.$user->id}}" class="btn"
                                       title="{{__('messages.comment')}}"><i class="fa fa-comment"></i></a></td>
                                <td><a href="{{env('APP_URL').'/admin/user/email/'.$user->id}}" class="btn"
                                       title="{{__('messages.send')}}"><i class="fa fa-send"></i></a></td>
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
