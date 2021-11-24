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
            @if(Session::has('success'))

                <p class="text-blue-600 font-bold mt-2">{{ Session::get('success') }}</p>

            @endif
        <div class="mt-2 text-lg">
            Wallet balance: <b>{{ Auth::user()->money }} $</b>
        </div>
            <br>
            @if(empty($stocks->all()))
                <p>You own no stocks!</p>
            @else
                <div class="mt-2 text-lg">
                    Total asset worth: <b>{{ $assetWorth }} $</b>
                </div>
            <div>
                Total PnL : <b>{{ $totalProfit }} $</b>
            </div>
            <table>
                <tr class="">
                    <th class="bg-gray-300 w-40">Company name </th>
                    <th class="bg-gray-300 mr-2 w-40">Company symbol </th>
                    <th class="bg-gray-300 mr-2 w-40">Quantity</th>
                    <th class="bg-gray-300 mr-2 w-40">Current price</th>
                    <th class="bg-gray-300 mr-2 w-40">Percent change</th>
                    <th class="bg-gray-300 mr-2 w-40">PnL</th>
                    <th class="bg-gray-300 mr-2 w-40">Total $</th>
                </tr>
                @foreach($stocks as $key => $stock)
                    <tr>
                        <td class="border border-gray-200 mr-2 text-center">{{ $stock->company_name }}</td>
                        <td class="border border-gray-200 mr-2 text-center">{{ $stock->ticker }}</td>
                        <td class="border border-gray-200 mr-2 text-center">{{ $stock->quantity }}</td>
                        <td class="border border-gray-200 mr-2 text-center">
                            {{ number_format($quotes[$key][0],2) }} $
                        </td>
                        <td class="border border-gray-200 mr-2 text-center">
                            {{ $quotes[$key][1] }} %
                        </td>
                        <td class="border border-gray-200 mr-2 text-center">
                            @if($quotes[$key][2] < 0)
                            <p class="text-red-600">{{ number_format($quotes[$key][2],2) }} $</p>
                                @elseif($quotes[$key][2] > 0)
                                <p class="text-green-600">{{ number_format($quotes[$key][2],2) }} $</p>
                                @else
                                {{ number_format($quotes[$key][2],2) }} $
                                @endif
                        </td>
                        <td class="border border-gray-200 mr-2 text-center">
                            {{ number_format($quotes[$key][3],2) }} $
                        </td>
                        <td class="">
                            <form action="/stock/{{$stock->ticker}}/sell" method="post">
                                @csrf
                                <label for="quantity"></label>
                                <input class="w-12 ml-2.5" type="text" id="quantity" name="quantity">
                                @if(now()->format("H:i")>'14:00' && now()->format("H:i") <'21:00')
                                <button class="m-2.5 border border-black hover:bg-gray-300 py-1 px-2 rounded text-red-600 hover:bg-red-300" onclick="return confirm('Are you sure?')" type="submit">Sell</button>
                                @else
                                    <button class="m-2.5 border border-black hover:bg-gray-300 py-1 px-2 rounded text-red-600 hover:bg-red-300" disabled type="submit" onclick="return confirm('Are you sure?')">Sell</button>
                                    @endif
                            </form>
                        </td>
                        @endforeach
                    </tr>
            </table>
                @endif



    </div>
</x-app-layout>
