@extends('client.layouts.layout')

@section('content')
    <div class="container">
        <div class="btn_create">
            <table>
                <tr>
                    <td>
                        <form action="{{env('APP_URL')}}/admin/soft_delete_user" method="post">
                            <input type="hidden" name="user_id" value="">
                            @csrf
                            <input type="hidden" name="target" value="remove_all">
                            <input type="submit" class="btn btn-danger" value="{{__('messages.remove_all')}}"
                                   onclick="return confirm('{{__('messages.are_you_sure')}}')">
                        </form>
                    </td>
                    <td>
                        <form action="{{env('APP_URL')}}/admin/soft_delete_user" method="post">
                            <input type="hidden" name="user_id" value="">
                            @csrf
                            <input type="hidden" name="target" value="recover_all">
                            <input type="submit" class="btn btn-success" value="{{__('messages.recovery_all')}}">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>{{__('messages.name')}}</th>
                <th>Email</th>
                <th>{{__('messages.created')}}</th>
                <th>{{__('messages.deleted')}}</th>
                <th>{{__('messages.action')}}</th>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->deleted_at}}</td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <form action="{{env('APP_URL')}}/admin/soft_delete_user" method="post">
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        @csrf
                                        <input type="hidden" name="target" value="remove_user">
                                        <button type="submit" class="btn" title="{{__('messages.remove')}}">
                                            <i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{env('APP_URL')}}/admin/soft_delete_user" method="post">
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        @csrf
                                        <input type="hidden" name="target" value="recover_user">
                                        <button type="submit" class="btn" title="{{__('messages.recovery')}}"
                                                onclick="return confirm('{{__('messages.are_you_sure')}}')">
                                            <i class="fas fa-undo"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="box-footer mt-4">
            <a href="/admin/users">
                <div class="btn btn-danger" title="{{__('messages.to_back')}}"><-----</div>
            </a>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#example');
    </script>
@endsection
