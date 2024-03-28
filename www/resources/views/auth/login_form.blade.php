<div class="container align-items-center">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <!-- Session Status -->
            <x-auth-session-status  :status="session('status')" />
            <h2 class="txt_h2">{{__('messages.login')}}</h2>
            <form method="POST" action="/login" class="form_login mt-2">
                @csrf
                <div class="mb-3">
                    <label for="email"  class="form-label text_label">Email</label>
                    <input class="form-control form_text" id="email" type="email" name="email" placeholder="email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mb-3">
                    <label  for="password" class="form-label text_label">Password</label>
                    <input class="form-control form_text" id="password" type="password" placeholder="Password" name="password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text_label text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center">
                    @if (Route::has('password.request'))
                        <a class="underline text_label text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit" class="btn text_label btn-primary mb-3">{{__('messages.login')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
