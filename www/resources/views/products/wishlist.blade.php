@extends('layouts.layout')

@section('content')
    <section class="featured-products">
        @if(count($products)>0)
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="section-title txt_h2">{{__('messages.favorite')}}</h3>
                    </div>
                    @foreach($products as $product)
                        <div class="col-lg-4 col-sm-6 mb-3">
                            <div class="product-card">
                                <div class="product-tumb">
                                    <a href="/product/{{$product->id}}"><img
                                            src="{{\Illuminate\Support\Facades\Storage::url($product->img)}}"
                                            alt=""></a>
                                </div>
                                @foreach($product->product_descriptions as $description)
                                    @if($description->language_id == $lang)
                                        <div class="product-details">
                                            <h4><a href="/product/{{$product->id}}">{{$description->title}}</a></h4>
                                            <p>{{$description->exerpt}}</p>
                                            <div class="product-bottom-details d-flex justify-content-between">
                                                <div class="product-price">
                                                    <small>{{$product->old_price>0?$product->old_price:''}}</small>{{$product->price}}
                                                </div>
                                                <input type="hidden" id="input-quantity" value="1">
                                                <div class="product-links">
                                                    <a href="/cart/add?id={{$product->id}}&qty=1" class="add-to-cart"
                                                       data-id="{{$product->id}}"><i class="fas fa-shopping-cart"
                                                                                     title="{{__('messages.add_to_cart')}}"></i></a>
                                                    <a href="/wishlist/remove?id={{$product->id}}"><i
                                                            class="far fa-heart"
                                                            title="{{__('messages.remove_favorite')}}"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </section>
    @else
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-title txt_h2">{{__('messages.no_products')}}</h3>
                </div>
            </div>
        </div>
    @endif
@endsection
