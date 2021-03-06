<?php

namespace App\Http\Controllers;

use App\Events\FundsAdded;
use App\Events\StocksBought;
use App\Events\StocksSold;
use App\Models\Stock;
use App\Models\Transaction;
use App\Repositories\Stock\StocksRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


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
        if(now()->format("H:i")<'14:30' && now()->format("H:i") >'21:00')
        {
            return redirect()->back()->withErrors(['',"The stock market is closed!"]);
        }

        $quote = $this->stocksRepository->getQuote($symbol);
        $company = $this->stocksRepository->getCompanyInfo($symbol);
        $total = $quote->getCurrentPrice() * $validated['amount'];
        $user = auth()->user();

        if ($total > auth()->user()->money) {
            return back()->withErrors(['', 'Not enough funds!']);
        }

        $stocks = Stock::where(['user_id' => $user->id, 'company_name' => $company->getName()])->get();
        if (empty($stocks->all())) {
            $stock = new Stock([
                'company_name' => $company->getName(),
                'ticker' => $company->getTicker(),
                'quantity' => $validated['amount'],
                'average_price' => $total/$validated['amount']
            ]);
            $stock->user()->associate(auth()->user());
            $stock->save();
        } else {
            $stock = $stocks->first();
            $stock->average_price = (($stock->average_price*$stock->quantity)+$total) / ($stock->quantity + $validated['amount']);
            $stock->quantity = $stock->quantity + $request['amount'];
            $stock->save();
        }

        $transaction = new Transaction([
            'price' => $quote->getCurrentPrice(),
            'quantity' => $validated['amount'],
            'type' => 'Buy',
            'company_name' => $company->getName(),
            'total' => $total
        ]);
        $transaction->user()->associate(auth()->user());
        $transaction->stock()->associate($stock);
        $transaction->save();

        $user->update(['money' => $user->money -= $total]);

        StocksBought::dispatch(auth()->user()->email,
            auth()->user()->name,
            $transaction->created_at,
            $transaction->company_name,
            $transaction->price,
            $stock->ticker,
            $transaction->quantity,
            $transaction->total
        );

        Session::flash('success', "You just purchased {$transaction->quantity} of {$transaction->company_name} stocks!");
        return redirect()->back();
    }

    public function sellStock(string $symbol, Request $request)
    {
        $request->validate(['quantity' => 'required|numeric|gt:0']);
        if(now()->format("H:i")<'14:30' && now()->format("H:i") >'21:00')
        {
            return redirect()->back()->withErrors(['',"The stock market is closed!"]);
        }
        $amount = $request['quantity'];
        $user = auth()->user();
        $quote = $this->stocksRepository->getQuote($symbol);
        $totalPrice = $quote->getCurrentPrice() * $amount;
        $stock = Stock::where(['user_id' => $user->id, 'ticker' => $symbol])->first();
        if ($amount > $stock->quantity) {
            return back()->withErrors(['', "You don't have this many shares!"]);
        }
        if ($amount == $stock->quantity) {
            $stock->delete();
            $user->update(['money' => $user->money += $totalPrice]);
            $transaction = new Transaction([
                'price' => $quote->getCurrentPrice(),
                'quantity' => $request['quantity'],
                'type' => 'Sell',
                'company_name' => $stock->company_name,
                'total' => $totalPrice
            ]);
            $transaction->user()->associate(auth()->user());
            $transaction->stock()->associate($stock);
            $transaction->save();
            return redirect()->back();

        }
        $stock->update(['quantity' => $stock->quantity -= $amount]);
        $user->update(['money' => $user->money += $totalPrice]);
        $transaction = new Transaction([
            'price' => $quote->getCurrentPrice(),
            'quantity' => $request['quantity'],
            'type' => 'Sell',
            'company_name' => $stock->company_name,
            'total' => $totalPrice
        ]);
        $transaction->user()->associate(auth()->user());
        $transaction->stock()->associate($stock);
        $transaction->save();

        StocksSold::dispatch(auth()->user()->email,
            auth()->user()->name,
            $transaction->created_at,
            $transaction->company_name,
            $transaction->price,
            $stock->ticker,
            $transaction->quantity,
            $transaction->total
        );
        Session::flash('success', "You just sold {$transaction->quantity} of {$transaction->company_name} stocks!");
        return redirect()->back();
    }

    public function showAddFundsPage(): view
    {
        return \view('funds/funds');
    }

    public function addFunds(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|gt:0',
            'name' => 'required|min:2',
            "lastName" => 'required|min:2',
            "address" => 'required',
            "ccNumber" => 'required|numeric|min:16',
            "ccExp" => 'required',
            "cvv" => 'required|numeric|min:3'
        ]);
        $user = auth()->user();
        $user->update(['money' => $user->money += $request['amount']]);
        FundsAdded::dispatch(
            $user->email,
            $user->name,
            $request['amount'],
            now()
        );
        return redirect()->back();
    }

    public function transactionHistory()
    {
        $transactions = Transaction::where(['user_id' => auth()->user()->id])->orderBy('created_at', 'desc')->paginate(10);
        return view('stocks/history', ['transactions' => $transactions]);
    }
}
