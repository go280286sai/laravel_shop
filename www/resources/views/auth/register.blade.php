@extends('layouts.layout')
@section('content')
    <div class="container align-items-center">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <!-- Session Status -->
                <x-auth-session-status  :status="session('status')" />
                <h2 class="txt_h2">{{__('messages.registration')}}</h2>
                <form method="POST" action="{{env('APP_URL')}}/register" class="form_login mt-2">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label text_label">Name</label>
                        <input class="form-control form_text" id="name" type="text" name="name" placeholder="name" value="{{old('name')}}">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <!-- Email Address -->
                    <div class="mb-3">
                         <label for="email" class="form-label text_label">Email</label>
                        <input class="form-control form_text" id="email" type="email" name="email" placeholder="email" value="{{old('email')}}">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label text_label">Password</label>
                        <input class="form-control form_text" id="password" type="password" name="password" placeholder="password" >
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label text_label">Confirm password</label>
                        <input class="form-control form_text" id="password_confirmation" type="password" name="password_confirmation" placeholder="confirm password">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text_label text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                        <button type="submit" class="btn text_label btn-primary mb-3">{{__('messages.registration')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
