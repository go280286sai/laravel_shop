@extends('client.layouts.layout')
    @section('content')
<div class="container">
    <form action="{{env('APP_URL')}}/admin/openssl/{{$resource->id}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name resource</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   name="name" value="{{$resource->name}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Public key</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="8" name="key">{{$publicKey}}</textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Url resource</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="url" value="{{$resource->url}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div class="mt-5">
        <a href="{{env('APP_URL')}}/admin/openssl"><div class="btn btn-success">Back</div></a>
    </div>
</div>
@endsection
