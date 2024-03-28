<?php

namespace go280286sai\search_json\Providers;

use go280286sai\search_json\Commands\ClearAllCommand;
use go280286sai\search_json\Commands\IndexSearchCommand;
use go280286sai\search_json\Commands\SearchCommand;
use go280286sai\search_json\Commands\SearchRemoveCommand;
use Illuminate\Support\ServiceProvider;

class SearchProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web_json.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        if ($this->app->runningInConsole()) {
            $this->commands([
                SearchCommand::class,
                SearchRemoveCommand::class,
                IndexSearchCommand::class,
                ClearAllCommand::class
            ]);
        }
    }
}
