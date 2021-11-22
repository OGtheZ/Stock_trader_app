<?php

namespace App\Listeners;

use App\Mail\StocksSoldMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class StocksSold
{
    /**
     * Create the event listener.
     *
     * @return void
     */
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
    public function handle(\App\Events\StocksSold $event)
    {
        Mail::to($event->getEmail())->send(new StocksSoldMail($event->getName(),
            $event->getTime(),
            $event->getStockName(),
            $event->getStockPrice(),
            $event->getStockTicker(),
            $event->getStockAmount(),
            $event->getTotalPrice()
        ));
    }
}
