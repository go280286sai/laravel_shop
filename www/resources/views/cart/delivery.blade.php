@extends('layouts.layout')

@section('content')
    @if($id == 1)
        @include("cart.deliveries.newpost")
    @elseif($id == 2)
        @include("cart.deliveries.ukrpost")
    @endif
<div class="container">
    <div class="row-md-6 offset-md-2">
        <table class="table align-middle">
            <tr>
                <td><a href="{{route('cart.delivery', ['id' => 1])}}"><img src="/assets/img/new_post.jpg" alt=""></a></td>
                <td><a href="{{route('cart.delivery', ['id' => 2])}}"><img src="/assets/img/ukr_poshta.jpg" alt=""></a></td>
            </tr>
        </table>
    </div>
</div>
@endsection
