<?php

namespace App\Listeners;

use App\Mail\FundsAddedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class FundsAdded
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
    public function handle($event)
    {
        Mail::to($event->getEmail())->send(new FundsAddedMail($event->getName(),
            $event->getAmount(),
            $event->getTime(),
        ));
    }
}
