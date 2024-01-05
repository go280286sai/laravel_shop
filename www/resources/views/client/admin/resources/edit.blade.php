@extends('client.layouts.layout')

@section('content')
    <div class="container">
        @include('layouts.errors')
        <form action="{{env('APP_URL')}}/admin/resources/{{$resource->id}}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" placeholder="Name" class="form-control"
                       id="name" aria-describedby="emailHelp" value="{{$resource->name}}">
                <div id="emailHelp" class="form-text">Add a name</div>
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">Url</label>
                <input type="text" name="url" placeholder="Url" class="form-control"
                       id="url" aria-describedby="emailHelp" value="{{$resource->url}}">
                <div id="emailHelp" class="form-text">Add a url</div>
            </div>
            <button type="submit" class="btn btn-primary">{{__('messages.update')}}</button>
        </form>
        <br>
        <a href="{{env('APP_URL')}}/admin/resources">
            <div class="btn btn-danger" title="{{__('messages.to_back')}}"><-----</div>
        </a>
    </div>

@endsection

@section('js')
@endsection
