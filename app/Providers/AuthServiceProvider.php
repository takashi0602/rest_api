<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Auth\AuthManager;
use Illuminate\Auth\RequestGuard;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Auth::viaRequest('custom-token', function ($request) {
//            $token = request()->bearerToken();
//            if ($token) {
//                return User::where("token", $token)->first();
//            } else {
//                return null;
//            }
//        });
    }

    public function register()
    {
        app()->extend(AuthManager::class,function(AuthManager $auth){
            $auth->extend('custom-token', function () use($auth) {
                $guard = new RequestGuard(function(){
                    $token = request()->bearerToken();
                    return \App\User::where("token",$token)->first();
                }, request(), $auth->createUserProvider());

                $this->app->refresh('request', $guard, 'setRequest');

                return $guard;
            });
        });
    }
}
