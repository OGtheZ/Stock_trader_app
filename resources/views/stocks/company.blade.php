<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$company->getName()}}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <img class="mt-3 mb-2 object-right" src="{{$company->getLogo()}}" alt="{{$company->getName()}}">
      <p>Company name: {{ $company->getName() }}</p>
      <p>Ticker: {{ $company->getTicker() }}</p>
      <p>Country: {{ $company->getCountry() }}</p>
      <p>Exchange: {{ $company->getExchange() }}</p>
      <p>Web: <a class="underline" target="_blank" href="{{ $company->getUrl() }}">{{ $company->getUrl() }}</a></p>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <p>Current price: {{$quote->getCurrentPrice()}} $</p>
    <p>Percent change: {{$quote->getPercentChange()}} %</p>
    <p>24H high price: {{$quote->getHighPrice()}} $</p>
    <p>24H low price: {{$quote->getLowPrice()}} $</p>
    <p>Open price: {{$quote->getOpenPrice()}} $</p>
    <p>Prev. close price: {{$quote->getPreviousClosePrice()}} $</p>
        <form action="/stock/{{$company->getTicker()}}/buy">
            @csrf
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount">
            <button class=" rounded bg-green-600 border-black py-2 px-4 " type="submit">Buy</button>
        </form>


    </div>
</x-app-layout>
