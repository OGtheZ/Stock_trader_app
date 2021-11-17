<?php

namespace App\Http\Controllers;


use App\Models\Company;
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

    public function showCompanies(Request $request)
    {
        $request->validate(['min:1']);
        $config = Configuration::getDefaultConfiguration()->setApiKey('token', 'c6a0h42ad3idi8g5l53g');
        $client = new DefaultApi(
            new Client(),
            $config
        );
        $data = $client->symbolSearch($request->company)->getResult();
        $companies = [];
        foreach($data as $company)
        {
            $companies[] = new Company($company->getDescription(), $company->getSymbol(), $company->getType());
        }
        return view('stocks/stocks',['companies' => $companies]);

    }

    public function showStockInfo(string $symbol)
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('token', 'c6a0h42ad3idi8g5l53g');
        $client = new DefaultApi(
            new Client(),
            $config
        );
        $data = $client->companyProfile2($symbol);
        var_dump($data);die;
    }
}
