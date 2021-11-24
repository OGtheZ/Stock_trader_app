<?php

namespace App\Http\Controllers;


use App\Models\Stock;
use App\Repositories\Stock\StocksRepository;
use Finnhub\ApiException;
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
        $request->validate(['company' => 'min:1']);

        $symbols = $this->stocksRepository->getCompanySymbol($request->company);
        if ($symbols == null) {
            return redirect()->back()->withErrors(['', "Nothing  was found!"]);
        }

        return view('stocks/stocks', ['symbols' => $symbols]);
    }

    public function showCompanyInfo(string $symbol)
    {
        try {
            $company = $this->stocksRepository->getCompanyInfo($symbol);
            $quote = $this->stocksRepository->getQuote($symbol);

            return \view('stocks/company',
                ['company' => $company,
                    'quote' => $quote]
            );
        } catch (ApiException $e) {
            return redirect()->back()->withErrors(['', "You don't have access to this resource."]);
        }

    }

    public function showPortfolio()
    {
        $stocks = Stock::where(['user_id' => auth()->user()->id])->get();
        $totalWorth = 0;
        $totalSpent = 0;
        $quotes = [];
        foreach ($stocks as $stock) {
            $quote = $this->stocksRepository->getQuote($stock->ticker);
            $totalStockWorth = $quote->getCurrentPrice() * $stock->quantity;
            $totalSpentOnStock = $stock->quantity * $stock->average_price;
            $profit = round($totalStockWorth - $totalSpentOnStock, 2);
            $totalSpent += $totalSpentOnStock;
            $totalWorth += $totalStockWorth;
            $quotes[] = [$quote->getCurrentPrice(), $quote->getPercentChange(), $profit, $totalStockWorth];
        }
        $totalWorth = round($totalWorth, 2);
        $totalSpent = round($totalSpent, 2);
        $totalProfit = round($totalWorth - $totalSpent, 2);
        return view('stocks/portfolio', ['stocks' => $stocks, "assetWorth" => $totalWorth, "quotes" => $quotes,
            'totalProfit' => $totalProfit]);
    }
}
