<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Transaction;
use App\Repositories\Stock\StocksRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TransactionsController extends Controller
{
    private StocksRepository $stocksRepository;

    public function __construct(StocksRepository $stocksRepository)
    {
        $this->stocksRepository = $stocksRepository;
    }

    public function buyStock(string $symbol, Request $request)
    {
        $validated = $request->validate(['amount' => 'required|numeric|gt:0']);

        $quote = $this->stocksRepository->getQuote($symbol);
        $company = $this->stocksRepository->getCompanyInfo($symbol);
        $total = $quote->getCurrentPrice() * $validated['amount'];
        $user = auth()->user();

        if($total > auth()->user()->money){
            return back()->withErrors(['', 'Not enough funds!']);
        }

        $stocks = Stock::where(['user_id' => $user->id, 'company_name' => $company->getName()])->get();
        if(empty($stocks->all())){
            $stock = new Stock([
                'company_name' => $company->getName(),
                'ticker' => $company->getTicker(),
                'quantity' => $validated['amount']
            ]);
            $stock->user()->associate(auth()->user());
            $stock->save();
        } else {
            $stock = $stocks->first();
            $stock->quantity = $stock->quantity + $request['amount'];
            $stock->save();
        }

        $transaction = new Transaction([
            'price' => $quote->getCurrentPrice(),
            'quantity' => $validated['amount'],
            'type' => 'Buy'
        ]);
        $transaction->user()->associate(auth()->user());
        $transaction->stock()->associate($stock);
        $transaction->save();

        $user->update(['money' => $user->money -= $total]);

        return redirect()->back();
    }

    public function sellStock(string $symbol, Request $request)
    {
        $request->validate(['quantity' => 'required|numeric|gt:0']);
        $amount = $request['quantity'];
        $user = auth()->user();
        $quote = $this->stocksRepository->getQuote($symbol);
        $totalPrice = $quote->getCurrentPrice() * $amount;
        $stock = Stock::where(['user_id' => $user->id, 'ticker' => $symbol])->first();
        if($amount > $stock->quantity)
        {
            return back()->withErrors(['', "You don't have this many shares!"]);
        }
        if($amount == $stock->quantity){
            $stock->delete();
            $user->update(['money' => $user->money += $totalPrice]);
            return redirect()->back();
        }
        $stock->update(['quantity' => $stock->quantity -= $amount]);
        $user->update(['money' => $user->money += $totalPrice]);
        $transaction = new Transaction([
            'price' => $quote->getCurrentPrice(),
            'quantity' => $request['quantity'],
            'type' => 'Sell'
        ]);
        $transaction->user()->associate(auth()->user());
        $transaction->stock()->associate($stock);
        $transaction->save();

        return redirect()->back();
    }

    public function showAddFundsPage(): view
    {
        return \view('funds/funds');
    }

    public function addFunds(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|gt:0']);
        $user = auth()->user();
        $user->update(['money' => $user->money += $request['amount']]);
        return redirect()->back();
    }
}
