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

            <table class="w-full">
                <tr class="">
                    <th class="border-2 border-black p-2 w-1/6">Company name </th>
                    <th class="border-2 border-black mr-2 w-1/6">Total </th>
                    <th class="border-2 border-black mr-2 w-1/6">Quantity</th>
                    <th class="border-2 border-black mr-2 w-1/6">Price</th>
                    <th class="border-2 border-black mr-2 w-1/6">Order type</th>
                    <th class="border-2 border-black mr-2 w-1/3">Order time</th>
                </tr>
                @foreach($transactions as $transaction)
                    <tr>
                        <td class="border border-gray-400 mr-2 text-center">{{ $transaction->company_name }}</td>
                        <td class="border border-gray-400 mr-2 text-center">{{ $transaction->total }}</td>
                        <td class="border border-gray-400 mr-2 text-center">{{ $transaction->quantity }}</td>
                        <td class="border border-gray-400 mr-2 text-center">{{ $transaction->price }}</td>
                        <td class="border border-gray-400 mr-2 text-center">{{ $transaction->type }}</td>
                        <td class="border border-gray-400 mr-2 text-center">{{ $transaction->created_at }}</td>
                        @endforeach
                    </tr>
            </table>
    </div>
</x-app-layout>
