<?php

namespace App\Repositories\Stock;

use http\Env\Request;

interface StocksRepository
{
    public function getCompanySymbol(string $name);

    public function getCompanyInfo(string $symbol);
}
