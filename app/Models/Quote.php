<?php

namespace App\Models;

class Quote
{
    private float $currentPrice;
    private float $percentChange;
    private float $highPrice;
    private float $lowPrice;
    private float $openPrice;
    private float $previousClosePrice;

    public function __construct(float $currentPrice,
                                float $percentChange,
                                float $highPrice,
                                float $lowPrice,
                                float $openPrice,
                                float $previousClosePrice
    )
    {
        $this->currentPrice = $currentPrice;
        $this->percentChange = $percentChange;
        $this->highPrice = $highPrice;
        $this->lowPrice = $lowPrice;
        $this->openPrice = $openPrice;
        $this->previousClosePrice = $previousClosePrice;
    }

    public function getCurrentPrice(): float
    {
        return $this->currentPrice;
    }


    public function getPercentChange(): float
    {
        return $this->percentChange;
    }

    function getHighPrice(): float
    {
        return $this->highPrice;
    }

    public function getLowPrice(): float
    {
        return $this->lowPrice;
    }

    public function getOpenPrice(): float
    {
        return $this->openPrice;
    }

    public function getPreviousClosePrice(): float
    {
        return $this->previousClosePrice;
    }
}
