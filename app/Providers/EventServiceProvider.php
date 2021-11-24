<?php

namespace App\Providers;

use App\Events\emailReceived;
use App\Events\FundsAdded;
use App\Events\StocksBought;
use App\Events\StocksSold;
use App\Listeners\sendEmailWhenEmailReceived;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        emailReceived::class => [
            sendEmailWhenEmailReceived::class,
        ],
        StocksBought::class => [
            \App\Listeners\StocksBought::class
        ],
        StocksSold::class => [
            \App\Listeners\StocksSold::class
        ],
        FundsAdded::class => [
            \App\Listeners\FundsAdded::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
