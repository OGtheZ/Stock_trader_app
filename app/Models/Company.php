<?php

namespace App\Models;

class Company
{
    private string $name;
    private string $symbol;
    private string $type;

    public function __construct(string $name, string $symbol, string $type)
    {
        $this->name = $name;
        $this->symbol = $symbol;
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
