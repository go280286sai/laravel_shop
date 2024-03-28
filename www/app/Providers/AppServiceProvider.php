<?php

namespace App\Providers;

use App\Models\Main;
use App\Models\Message;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.layout', function ($view) {
            $mains = Main::list();
            $view->with('mains', $mains);
        });
        View::composer('client.layouts.left', function ($view) {
           $messages = Message::where('is_read', 0)->get()->count();
           $view->with('messages', $messages);
        });
    }
}
