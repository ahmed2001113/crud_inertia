<?php

namespace App\Providers;

// use GuzzleHttp\Psr7\Request;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Http\Request ;
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
    public function boot(Request $request): void
    {
        Inertia::share([

            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'class' => fn () => $request->session()->get('class')
            ],

            'user' => fn () => $request->user() ?
            [
                'data' => $request->user()->only(['id' , 'name' , 'email' , 'photo_url']) ,
                'notifications' => $request->user()->unreadNotifications()->count()
            ]
            : null
        ]) ;
    }
}
