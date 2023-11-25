@extends('layouts.layout')
@section('content')
    <div class="container align-items-center">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <!-- Session Status -->
                <x-auth-session-status :status="session('status')"/>
                <form method="POST" action="/confirm-password" class="form_login mt-2">
                    @csrf
                    <p class="text_label">{{__('messages.forgot_password')}}</p>
                    <div class="mb-3">
                        <label for="email" class="form-label text_label">Email</label>
                        <input class="form-control form_text" id="email" type="email" name="email" placeholder="email">
                    </div>
                    <div class="flex items-center">
                        <button type="submit" class="btn text_label btn-primary mb-3">{{__('messages.recovery_password')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
