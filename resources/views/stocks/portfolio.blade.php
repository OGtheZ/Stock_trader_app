<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Portfolio
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @foreach ($errors->all() as $error)
            <p class="text-red-600 font-bold mt-2">{{ $error }}</p>
        @endforeach

        <div class="mt-2 text-lg">
            Wallet balance: <b>{{ Auth::user()->money }} $</b>
        </div>
            <div class="mt-2 text-lg">
                Total asset worth: <b>{{ $assetWorth }} $</b>
            </div>
            <br>
            @if(empty($stocks->all()))
                <p>You own no stocks!</p>
            @else
            <table>
                <tr class="">
                    <th class="bg-gray-300 w-1/5">Company name </th>
                    <th class="bg-gray-300 mr-2 w-1/5">Company symbol </th>
                    <th class="bg-gray-300 mr-2 w-1/5">Quantity</th>
                    <th class="bg-gray-300 mr-2 w-1/5">Current price</th>
                    <th class="bg-gray-300 mr-2 w-1/5">Percent change</th>
                </tr>
                @foreach($stocks as $key => $stock)
                    <tr>
                        <td class="border border-gray-200 mr-2 text-center">{{ $stock->company_name }}</td>
                        <td class="border border-gray-200 mr-2 text-center">{{ $stock->ticker }}</td>
                        <td class="border border-gray-200 mr-2 text-center">{{ $stock->quantity }}</td>
                        <td class="border border-gray-200 mr-2 text-center">
                            {{ $quotes[$key][0] }} $
                        </td>
                        <td class="border border-gray-200 mr-2 text-center">
                            {{ $quotes[$key][1] }} %
                        </td>
                        <td class="">
                            <form action="/stock/{{$stock->ticker}}/sell" method="post">
                                @csrf
                                <label for="quantity"></label>
                                <input class="w-12 ml-2.5" type="text" id="quantity" name="quantity">
                                <button class="m-2.5 border border-black hover:bg-gray-300 py-1 px-2 rounded text-red-600 hover:bg-red-300" type="submit">Sell</button>
                            </form>
                        </td>
                        @endforeach
                    </tr>
            </table>
                @endif



    </div>
</x-app-layout>
