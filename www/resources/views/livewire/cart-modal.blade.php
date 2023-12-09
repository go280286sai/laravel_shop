<div>

    <table class="table table-hover">
        <tr class="table-dark">
            <th>{{__('messages.title')}}</th>
            <th>{{__('messages.price').", ".env('APP_MONEY')}}</th>
            <th>{{__('messages.quantity').", ".env('APP_COUNT')}}</th>
            <th>{{__('messages.sum').", ".env('APP_MONEY')}}</th>
            <th>{{__('messages.action')}}</th>
        </tr>
        @php
            $total_qty = 0;
            $total_price = 0;
        @endphp
        @foreach($carts as $cart)
            <tr class="table-light">
                <td>{{$cart->title}}</td>
                <td>{{$cart->price}}</td>
                <td>
                    @php
                        $total_qty += $cart->qty;
                        $total_price += $cart->price * $cart->qty;
                    @endphp


                    <form wire:submit="save({{$cart->id}})">
                        <label>
                           {{$cart->qty}}
                        </label>
                        <input type="number" style="width: 50px" value="{{$cart->qty}}" wire:model="new_qty">
                        <button type="submit" class="btn btn-success"> <strong class="fa fa-reply">
                            </strong></button>
                    </form>

                </td>
                <td>{{$cart->price * $cart->qty}}</td>
                <td>
                    <i class="btn btn-danger" wire:click="remove({{$cart->id}})" title="{{__('messages.remove')}}">
                        <strong class="fa fa-remove">
                        </strong></i>
                </td>
            </tr>
        @endforeach
    </table>
    <div>
        <table class="table">
            <tr class="table-dark">
                <td>{{__('messages.total')}}</td>
                <td>{{$total_price.".".env('APP_MONEY')}}</td>
            </tr>
            <tr class="table-dark">
                <td>{{__('messages.all_products')}}</td>
                <td>{{$total_qty." ".env('APP_COUNT')}}</td>
        </table>
    </div>
    @if($total_qty > 0)
        <div class="modal-footer">
            <button type="button" class="btn btn-success ripple" data-bs-dismiss="modal" wire:click="continue"
                    title="{{__('messages.continue')}}">{{__('messages.continue')}}
            </button>

            @if(\Illuminate\Support\Facades\URL::current()==env('APP_URL').'/cart/store')
                <strong wire:click="delivery">
                    <div class="btn btn-primary" title="{{__('messages.order')}}">{{__('messages.order')}}</div>
                </strong>
            @else
                <strong wire:click="store">
                    <div class="btn btn-primary" title="{{__('messages.order')}}">{{__('messages.order')}}</div>
                </strong>
            @endif



            <strong wire:click="clear" wire:confirm="{{__('messages.are_you_sure')}}">
                <div class="btn btn-danger" title="{{__('messages.clean_cart')}}">{{__('messages.clean_cart')}}</div>
            </strong>
        </div>
@endif
</div>

