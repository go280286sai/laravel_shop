<div>
    <i class="btn btn-primary mb-3" wire:click="addToFavorite({{$id}})" title="{{__('messages.to_favorite')}}">
        <strong class="fa fa-heart"
                data-id="{{$id}}"> {{__('messages.to_favorite')}}
        </strong></i>
    <div id="product">
        <div class="input-group mb-3">
            <button class="btn btn-danger add-to-cart" type="button" wire:click="addToCart({{$id}})"
                    data-id="{{$id}}">{{__('messages.to_buy')}}</button>
        </div>
    </div>
</div>

