@extends('layouts.layout')

@section('content')
    @include('layouts.slide')
    <section class="featured-products">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-title txt_h2">{{__('messages.recommended_products')}}</h3>
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
                                                <a href="/wishlist/add?id={{$product->id}}"><i
                                                        class="add_to_favorite far fa-heart "
                                                        data-id="{{$product->id}}"
                                                        title="{{__('messages.to_favorite')}}"></i></a>
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
    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-title txt_h2">{{__('messages.our_advantages')}}</h3>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <p class="text-center"><i class="fas fa-shipping-fast"></i></p>
                        <p>{{__('messages.direct_from')}}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <p class="text-center"><i class="fas fa-cubes"></i></p>
                        <p>{{__('messages.range_of_goods')}}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <p class="text-center"><i class="fas fa-hand-holding-usd"></i></p>
                        <p>{{__('messages.good_price')}}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <p class="text-center"><i class="fas fa-user-cog"></i></p>
                        <p>{{__('messages.advice_service')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
@endsection
