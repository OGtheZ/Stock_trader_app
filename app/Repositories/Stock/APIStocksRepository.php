<?php

namespace App\Repositories\Stock;

use App\Models\Company;
use App\Models\Quote;
use App\Models\Symbol;
use Finnhub\Api\DefaultApi;
use Finnhub\ApiException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class APIStocksRepository implements StocksRepository
{
    private DefaultApi $client;

    public function __construct(DefaultApi $client)
    {
        $this->client = $client;
    }


    public function getCompanySymbol(string $name): ?array
    {

        $cacheKey = 'companies' . Str::snake(strtolower($name));

        if (cache()->has($cacheKey)) {
            return cache()->get($cacheKey);
        }


        $data = $this->client->symbolSearch($name)->getResult();
        if(empty($data)){
            return null;
        }
        $symbols = [];
        foreach($data as $company)
        {
            $symbols[] = new Symbol(
                $company->getDescription(),
                $company->getSymbol(),
                $company->getType()
            );
        }

        cache()->put($cacheKey, $symbols, now()->addMinutes(10));
        return $symbols;
    }

    public function getCompanyInfo(string $symbol): Company
    {
        $cacheKey = 'symbols' . Str::snake(strtolower($symbol));

        if (cache()->has($cacheKey)) {
            return cache()->get($cacheKey);
        }

        $companyData = $this->client->companyProfile2($symbol);
        if($companyData->getName() == null)
        {
            throw new ApiException("You don't have access to this resource!");
        }
        $company = new Company(
            $companyData->getName(),
            $companyData->getTicker(),
            $companyData->getCountry(),
            $companyData->getExchange(),
            $companyData->getLogo(),
            $companyData->getWeburl()
        );
        cache()->put($cacheKey, $company, now()->addMinutes(10));
        return $company;

    }

    public function getQuote(string $symbol): Quote
    {
        $cacheKey = 'quote' . Str::snake(strtolower($symbol));

        if (cache()->has($cacheKey)) {
            return cache()->get($cacheKey);
        }

        $quoteData = $this->client->quote($symbol);
        $quote = new Quote(
            $quoteData->getC(),
            $quoteData->getDp(),
            $quoteData->getH(),
            $quoteData->getL(),
            $quoteData->getO(),
            $quoteData->getPc(),
        );
        cache()->put($cacheKey, $quote, now()->addMinutes(10));
        return $quote;
    }
}
