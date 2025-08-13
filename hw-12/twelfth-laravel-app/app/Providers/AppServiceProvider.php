<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\User;
use App\Policies\UserPolicy;

use GuzzleHttp\Client as GuzzleClient;
use Telegram\Bot\TelegramClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(TelegramClient::class, function () {
            return new TelegramClient(new GuzzleClient([
                'timeout'         => 15,
                'connect_timeout' => 5,
                // 'proxy' => env('TELEGRAM_PROXY'), // http://user:pass@host:port
                // 'verify' => true, // не выключай без необходимости
            ]));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    protected $policies = [
        User::class => UserPolicy::class,
    ];
}
