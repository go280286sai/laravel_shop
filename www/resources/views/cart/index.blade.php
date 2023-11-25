@extends('layouts.layout')
@section('css')

@endsection
@section('content')
    @if(!\Illuminate\Support\Facades\Auth::check())
        @include('auth.login_form')
    @else
        <div class="container">
            <div class="row">
                <input type="hidden" id="lang" value="{{$lang}}">
                <div id="create_cart">
                </div>
            </div>
        </div>
    @endif
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            const lang = document.getElementById('lang').value;
            create_cart(lang);
        })
    </script>


@endsection
