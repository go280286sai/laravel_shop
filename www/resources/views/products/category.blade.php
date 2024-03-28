@extends('layouts.layout')
@section('content')
    <div class="container">
        <livewire:breadcrumb-model :id="$id" :target="'category'"/>
    </div>
    <section class="featured-products">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-title">{{$category->category_title}}</h3>
                </div>
                @foreach($products as $product)
                    <div class="col-lg-4 col-sm-6 mb-3">
                        <div class="product-card">
                            <div class="product-tumb">
                                <a href="/product/{{$product->id}}"><img
                                        src="{{\Illuminate\Support\Facades\Storage::url($product->img)}}"
                                        alt=""></a>
                            </div>
                            <div class="product-details">
                                <h4><a href="/product/{{$product->id}}">{{$product->title}}</a></h4>
                                <p>{{ strip_tags(html_entity_decode($product->exerpt, ENT_QUOTES, 'UTF-8')) }}</p>
                                <div class="product-bottom-details d-flex justify-content-between">
                                    <div class="product-price">
                                        <small>{{$product->old_price>0?$product->old_price:''}}</small>{{$product->price." ".env('APP_MONEY')}}
                                    </div>
                                    <input type="hidden" id="input-quantity" value="1">
                                    <livewire:main :product_id="$product->id"/>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">{{ $products->links() }}</div>
    </div>
@endsection
@section('js')
@endsection
