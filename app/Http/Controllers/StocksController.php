<?php

namespace App\Http\Controllers;


use App\Models\Company;
use App\Models\Quote;
use App\Models\Symbol;
use Finnhub\Api\DefaultApi;
use Finnhub\Configuration;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StocksController extends Controller
{
    public function index(): view
    {
        return view('stocks/stocks');
    }

    public function showSymbols(Request $request)
    {
        $request->validate(['min:1']);
        $config = Configuration::getDefaultConfiguration()->setApiKey('token', 'c6a0h42ad3idi8g5l53g');
        $client = new DefaultApi(
            new Client(),
            $config
        );
        $data = $client->symbolSearch($request->company)->getResult();
        $symbolData = $data[0];
        $symbol = new Symbol(
            $symbolData->getDescription(),
            $symbolData->getSymbol(),
            $symbolData->getType()
        );
        $symbols = [$symbol];

        return view('stocks/stocks', ['symbols' => $symbols]);

    }

    public function showCompanyInfo(string $symbol)
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('token', 'c6a0h42ad3idi8g5l53g');
        $client = new DefaultApi(
            new Client(),
            $config
        );
        $companyData = $client->companyProfile2($symbol);
        $company = new Company(
            $companyData->getName(),
            $companyData->getTicker(),
            $companyData->getCountry(),
            $companyData->getExchange(),
            $companyData->getLogo(),
            $companyData->getWeburl()
        );
        $quoteData = $client->quote($symbol);
        $quote = new Quote(
            $quoteData->getC(),
            $quoteData->getDp(),
            $quoteData->getH(),
            $quoteData->getL(),
            $quoteData->getO(),
            $quoteData->getPc(),
        );

        return \view('stocks/company',
            ['company' => $company,
            'quote' => $quote]
        );

    }
}
