@extends('layouts.layout')
@section('css')

@endsection
@section('content')
    @if(!\Illuminate\Support\Facades\Auth::check())
        @include('auth.login_form')
    @else
        <div class="container"><livewire:cart-modal /></div>

    @endif
@endsection


@section('js')
@endsection
