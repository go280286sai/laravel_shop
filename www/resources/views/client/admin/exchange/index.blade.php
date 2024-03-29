@extends('client.layouts.layout')

@section('content')
    <div class="container">
        @include("layouts.errors")
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div>
                <livewire:get-parse-data-model />
    </div>
    </div>
@endsection
@section('js')
@endsection
