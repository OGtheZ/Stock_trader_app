<?php

namespace App\Http\Controllers;


use App\Models\Company;
use App\Models\Quote;
use App\Models\Symbol;
use App\Repositories\Stock\StocksRepository;
use Finnhub\Api\DefaultApi;
use Finnhub\Configuration;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StocksController extends Controller
{
    private StocksRepository $stocksRepository;

    public function __construct(StocksRepository $stocksRepository)
    {
        $this->stocksRepository = $stocksRepository;
    }

    public function index(): view
    {
        return view('stocks/stocks');
    }

    public function showSymbols(Request $request)
    {
        $request->validate(['min:1']);

        $symbols = $this->stocksRepository->getCompanySymbol($request->company);

        return view('stocks/stocks', ['symbols' => $symbols]);
    }

    public function showCompanyInfo(string $symbol)
    {
        $company = $this->stocksRepository->getCompanyInfo($symbol);
        $quote = $this->stocksRepository->getQuote($symbol);

        return \view('stocks/company',
            ['company' => $company,
            'quote' => $quote]
        );

    }
}
