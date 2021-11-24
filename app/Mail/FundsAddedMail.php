<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FundsAddedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private string $name;
    private float $amount;
    private string $time;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, float $amount, string $time)
    {
        //
        $this->name = $name;
        $this->amount = $amount;
        $this->time = $time;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail/funds-added', ['name' => $this->name,
            'amount' => $this->amount,
            'time' => $this->time])
            ->from('info@tothemoon.com');
    }
}
