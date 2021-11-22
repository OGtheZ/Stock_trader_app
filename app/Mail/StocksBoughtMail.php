<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StocksBoughtMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $name;
    private string $time;
    private string $stockName;
    private string $stockPrice;
    private string $stockTicker;
    private string $stockAmount;
    private string $totalPrice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name,
                                string $time,
                                string $stockName,
                                string $stockPrice,
                                string $stockTicker,
                                string $stockAmount,
                                string $totalPrice
    )
    {
        $this->name = $name;
        $this->time = $time;
        $this->stockName = $stockName;
        $this->stockPrice = $stockPrice;
        $this->stockTicker = $stockTicker;
        $this->stockAmount = $stockAmount;
        $this->totalPrice = $totalPrice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail/stocks-bought', ['name' => $this->name,
            'time' => $this->time,
            'stockName' => $this->stockName,
            'stockPrice' => $this->stockPrice,
            'stockTicker' => $this->stockTicker,
            'stockAmount' => $this->stockAmount,
            'totalPrice' => $this->totalPrice
            ])
            ->from('info@tothemoon.com');
    }
}
