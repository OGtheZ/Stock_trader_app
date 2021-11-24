<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order history
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @foreach ($errors->all() as $error)
            <p class="text-red-600 font-bold mt-2">{{ $error }}</p>
        @endforeach

            <table class="w-full mt-2">
                <tr class="">
                    <th class="p-2 w-1/6 bg-gray-300">Company name </th>
                    <th class="bg-gray-300 mr-2 w-1/6">Total </th>
                    <th class="bg-gray-300 mr-2 w-1/6">Quantity</th>
                    <th class="bg-gray-300 mr-2 w-1/6">Price</th>
                    <th class="bg-gray-300 mr-2 w-1/6">Order type</th>
                    <th class="bg-gray-300 mr-2 w-1/3">Order time</th>
                </tr>
                @foreach($transactions as $transaction)
                    <tr>
                        <td class="border border-gray-200 mr-2 text-center">{{ $transaction->company_name }}</td>
                        <td class="border border-gray-200 mr-2 text-center">{{ number_format($transaction->total,2) }} $</td>
                        <td class="border border-gray-200 mr-2 text-center">{{ $transaction->quantity }}</td>
                        <td class="border border-gray-200 mr-2 text-center">{{ number_format($transaction->price,2) }} $</td>
                        @if($transaction->type == 'Buy')
                        <td class="border border-gray-200 mr-2 text-center text-green-600">{{ $transaction->type }}</td>
                        @else
                            <td class="border border-gray-200 mr-2 text-center text-red-600">{{ $transaction->type }}</td>
                        @endif
                        <td class="border border-gray-200 mr-2 text-center">{{ $transaction->created_at }}</td>
                        @endforeach
                    </tr>
            </table>
        {{ $transactions->links() }}
    </div>
</x-app-layout>
