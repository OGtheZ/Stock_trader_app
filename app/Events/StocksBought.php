<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StocksBought
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

    public function __construct(string $email,
                                string $name,
                                string $time,
                                string $stockName,
                                string $stockPrice,
                                string $stockTicker,
                                string $stockAmount,
                                string $totalPrice
    )
    {
        $this->email = $email;
        $this->name = $name;
        $this->time = $time;
        $this->stockName = $stockName;
        $this->stockPrice = $stockPrice;
        $this->stockTicker = $stockTicker;
        $this->stockAmount = $stockAmount;
        $this->totalPrice = $totalPrice;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function getStockName(): string
    {
        return $this->stockName;
    }

    public function getStockPrice(): string
    {
        return $this->stockPrice;
    }

    public function getStockTicker(): string
    {
        return $this->stockTicker;
    }

    public function getStockAmount(): string
    {
        return $this->stockAmount;
    }

    public function getTotalPrice(): string
    {
        return $this->totalPrice;
    }
}
