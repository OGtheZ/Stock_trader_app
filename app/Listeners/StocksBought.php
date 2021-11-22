<?php

namespace App\Listeners;

use App\Mail\StocksBoughtMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class StocksBought
{

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(\App\Events\StocksBought $event)
    {
        Mail::to($event->getEmail())->send(new StocksBoughtMail($event->getName(),
        $event->getTime(),
        $event->getStockName(),
        $event->getStockPrice(),
        $event->getStockTicker(),
        $event->getStockAmount(),
        $event->getTotalPrice()
        ));
    }
}
