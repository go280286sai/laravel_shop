<div>
    <div class="product-links">
        <i class="btn btn-danger" wire:click="addToCart({{$product_id}})"
           data-id="{{$product_id}}" title="{{__('messages.add_to_cart')}}">
            <strong class="fa fa-shopping-cart"></strong></i>
        <i class="btn btn-danger" wire:click="removeFromFavorite({{$product_id}})"
           data-id="{{$product_id}}" title="{{__('messages.remove_favorite')}}">
            <strong class="fa fa-remove"></strong></i>
    </div>
</div>
