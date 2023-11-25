@extends('client.layouts.layout')
    @section('content')

<div class="container">
    <div class="row">
        <a href="{{env('APP_URL')}}/admin/openssl/create"><div class="btn btn-primary">Add resource</div></a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Url</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($resource as $item)
        <tr>
            <th scope="row">{{$item['id']}}</th>
            <td><a href="{{env('APP_URL')}}/admin/openssl/{{$item['id']}}/edit">{{$item['name']}}</a></td>
            <td>{{$item['url']}}</td>
            <td>
                <form action="{{env('APP_URL')}}/admin/openssl/{{$item['id']}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
               </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
