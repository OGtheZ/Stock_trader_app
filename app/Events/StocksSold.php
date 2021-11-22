<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StocksSold
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $email;
    private string $name;
    private string $time;
    private string $stockName;
    private string $stockPrice;
    private string $stockTicker;
    private string $stockAmount;
    private string $totalPrice;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $email,
                                string $name,
                                string $time,
                                string $stockName,
                                string $stockPrice,
                                string $stockTicker,
                                string $stockAmount,
                                string $totalPrice)
    {
        //
        $this->email = $email;
        $this->name = $name;
        $this->time = $time;
        $this->stockName = $stockName;
        $this->stockPrice = $stockPrice;
        $this->stockTicker = $stockTicker;
        $this->stockAmount = $stockAmount;
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @return string
     */
    public function getStockName(): string
    {
        return $this->stockName;
    }

    /**
     * @return string
     */
    public function getStockPrice(): string
    {
        return $this->stockPrice;
    }

    /**
     * @return string
     */
    public function getStockTicker(): string
    {
        return $this->stockTicker;
    }

    /**
     * @return string
     */
    public function getStockAmount(): string
    {
        return $this->stockAmount;
    }

    /**
     * @return string
     */
    public function getTotalPrice(): string
    {
        return $this->totalPrice;
    }
}
