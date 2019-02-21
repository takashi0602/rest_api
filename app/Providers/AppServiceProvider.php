<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\TaskRepository;
use App\Repository\TaskRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->singleton(TaskRepositoryInterface::class, function(){
            return new TaskRepository();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
