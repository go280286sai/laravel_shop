@extends('layouts.layout')

@section('content')
    @switch($id)
    @case(1)
        @include('cart.orders.e-wallet')
    @break
    @case(2)
        @include('cart.orders.card')
    @break
    @default
        @include('cart.orders.card')
    @endswitch
@endsection
