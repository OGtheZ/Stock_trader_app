<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Stocks
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @foreach ($errors->all() as $error)
        <p class="text-red-600 font-bold mt-2">{{ $error }}</p>
        @endforeach
    <form class="mt-2" action="/stocks" method="post">
        @csrf
        <label class="content-center" for="company">Company name :</label><br>
        <input class="content-center rounded mb-2" type="text" value="{{ old('title') }}" placeholder="Search for a company" id="company" name="company">
        <button type="submit" class="content-center m-1 border p-1.5 rounded border-black hover:bg-gray-300 lg:transition-opacity"><i class="fa fa-search"></i></button>
    </form>


        @if(!empty($symbols))
            <table>
                <tr class="">
                    <th class="bg-gray-400 p-1 mt-2 w-1/3">Company name </th>
                    <th class="bg-gray-400 p-1 mt-2 w-1/3">Company symbol </th>
                    <th class="bg-gray-400 p-1 mt-2 w-1/3">Stock type</th>
                </tr>
                @foreach($symbols as $symbol)
                    <tr>
                        <td class="border border-gray-300 text-center">{{ $symbol->getName() }}</td>
                        <td class="border border-gray-300 text-center">{{ $symbol->getSymbol() }}</td>
                        <td class="border border-gray-300 text-center">{{ $symbol->getType() }}</td>
                        <td class="">
                            <form action="/stock/{{$symbol->getSymbol()}}">
                                @csrf
                                <button class="m-2.5 border border-gray-300 py-1 px-2 hover:bg-gray-300 rounded" type="submit">Trade</button>
                            </form>
                        </td>
                        @endforeach
                    </tr>
            </table>
            @endif
    </div>
</x-app-layout>
