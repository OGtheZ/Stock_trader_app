<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$company->getName()}}
        </h2>
    </x-slot>
    <div class="grid grid-cols-2 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8  mt-2 gap-2">

    <div class="bg-gray-300 rounded">
        <div class="flex items-center justify-center">
            <img class="mb-2 rounded place-items-center mt-2" src="{{$company->getLogo()}}" alt="{{$company->getName()}}">
        </div>
        <div class="text-center">
            <p>Company name: {{ $company->getName() }}</p>
            <p>Ticker: {{ $company->getTicker() }}</p>
            <p>Country: {{ $company->getCountry() }}</p>
            <p>Exchange: {{ $company->getExchange() }}</p>
            <p>Web: <a class="underline" target="_blank" href="{{ $company->getUrl() }}">{{ $company->getUrl() }}</a></p>
        </div>

    </div >
    <div class="max-w-7xl px-4 sm:px-6 lg:px-8 bg-gray-300 rounded">
    <p class="mt-2">Current price: {{round($quote->getCurrentPrice(),2)}} $</p>
    <p>Percent change: {{$quote->getPercentChange()}} %</p>
    <p>24H high price: {{$quote->getHighPrice()}} $</p>
    <p>24H low price: {{$quote->getLowPrice()}} $</p>
    <p>Open price: {{$quote->getOpenPrice()}} $</p>
    <p>Prev. close price: {{$quote->getPreviousClosePrice()}} $</p>
        @foreach ($errors->all() as $error)
            <p class="text-red-600 font-bold mt-2">{{ $error }}</p>
        @endforeach
        @if(Session::has('success'))

           <p class="text-blue-600 font-bold mt-2">{{ Session::get('success') }}</p>

        @endif
        <form action="/stock/{{$company->getTicker()}}/buy" method="post">
            @csrf

                <label for="amount">Amount:</label>
                <input type="text" id="amount" name="amount">
            @if(now()->format("H:i")>'14:30' && now()->format("H:i") <'21:00')
                <button class="mb-2 rounded bg-green-400 border-green py-2 px-4 hover:bg-green-600 " type="submit">Buy</button>
            @else
                <button class="mb-2 rounded bg-gray-600 border-green py-2 px-4 " disabled type="submit">Buy</button>
                @endif
            <p class="mt-2 text-lg"><b>Stock purchases are available from 14:30-21:00(UTC)</b></p>


        </form>
    </div>

    </div>
</x-app-layout>
