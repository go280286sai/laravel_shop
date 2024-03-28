@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($search as $product)
                @if($product['language_id'] == $lang)
                    <h3><a href="{{env('APP_URL')}}/product/{{$product['product_id']}}">{{$product['title']}}</a></h3>
                    <p>{{$product['content']}}</p>
                @endif
            @endforeach
        </div>
    </div>

@endsection
