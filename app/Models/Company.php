<?php

namespace App\Models;

class Company
{
    private string $name;
    private string $ticker;
    private string $country;
    private string $exchange;
    private string $logo;
    private string $url;

    public function __construct(string $name,
                                string $ticker,
                                string $country,
                                string $exchange,
                                string $logo,
                                string $url
    )
    {
        $this->name = $name;
        $this->ticker = $ticker;
        $this->country = $country;
        $this->exchange = $exchange;
        $this->logo = $logo;
        $this->url = $url;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getExchange(): string
    {
        return $this->exchange;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function getTicker(): string
    {
        return $this->ticker;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
