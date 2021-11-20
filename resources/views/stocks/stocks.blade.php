<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Stocks
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <form action="/stocks" method="post">
        @csrf
        <label class="content-center" for="company">Company name</label><br>
        <input class="content-center rounded" type="text" id="company" name="company">
        <button type="submit" class="content-center m-1 border p-1.5 rounded border-black hover:bg-gray-300 lg:transition-opacity"><i class="fa fa-search"></i></button>
    </form>


        @if(!empty($symbols))
            <table>
                <tr class="">
                    <th class="pr-2">Company name </th>
                    <th class="pr-2">Company symbol </th>
                    <th class="pr-2">Stock type</th>
                </tr>
                @foreach($symbols as $symbol)
                    <tr>
                        <td class="border-gray-500">{{ $symbol->getName() }}</td>
                        <td class="">{{ $symbol->getSymbol() }}</td>
                        <td class="">{{ $symbol->getType() }}</td>
                        <td class="">
                            <form action="/stock/{{$symbol->getSymbol()}}">
                                @csrf
                                <button class="m-2.5 border hover:bg-gray-300" type="submit">Info</button>
                            </form>
                        </td>
                        @endforeach
                    </tr>
            </table>
            @endif
    </div>
</x-app-layout>
