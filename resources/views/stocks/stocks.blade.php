<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Stocks
        </h2>
    </x-slot>

    <div class="py-12">
        <form action="/stocks" method="post">
            @csrf
            <label class="m-1 content-center" for="company">Company name</label><br>
            <input class="m-1 content-center" type="text" id="company" name="company">
            <button type="submit" class="content-center m-1 border p-1.5 rounded border-black hover:bg-gray-300 lg:transition-opacity"><i class="fa fa-search"></i></button>
        </form>
        @if(!empty($companies))
            <table class="m-2">
                <tr>
                    <th>Company name</th>
                    <th>Company symbol</th>
                    <th>Stock type</th>
                </tr>
                @foreach($companies as $company)
                    <tr>
                        <td>{{ $company->getName() }}</td>
                        <td>{{ $company->getSymbol() }}</td>
                        <td>{{ $company->getType() }}</td>
                        <td>
                            <form action="/stock/{{$company->getSymbol()}}">
                                @csrf
                                <button class="m-2.5 border hover:bg-gray-300" type="submit">Buy/Sell</button>
                            </form>
                        </td>
                        @endforeach
                    </tr>
            </table>
            @endif
    </div>
</x-app-layout>
