<div>
    <div class="product-links">
        <i class="btn btn-danger" wire:click="addToCart({{$product_id}})"
           data-id="{{$product_id}}" title="{{__('messages.add_to_cart')}}"><strong class="fa fa-shopping-cart"
            ></strong></i>
        <i class="btn btn-danger" wire:click="addToFavorite({{$product_id}})" title="{{__('messages.to_favorite')}}">
            <strong class="fa fa-heart "
                    data-id="{{$product_id}}">
            </strong></i>
        <i class="btn btn-danger" wire:click="addToLike({{$product_id}})" title="Like">
            <strong class="fa fa-thumbs-up"
                    data-id="{{$product_id}}">
            </strong></i>
    </div>
</div>
