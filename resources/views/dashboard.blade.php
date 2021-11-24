<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-lg">Welcome to the To The Moon exchange!</p>
                    <br>

                    To buy stocks visit the <a class="text-purple-400 hover:text-blue-600" href="/stocks">Buy stocks</a> page!
                    <br>
                    You can see your asasets in the <a class="text-purple-400 hover:text-blue-600" href="/portfolio">Portfolio</a> tab!
                    <br>
                    To add funds, just visit the <a class="text-purple-400 hover:text-blue-600" href="/addFunds">Add funds</a> section of the website!
                    <br>
                    Your order history is available in the <a class="text-purple-400 hover:text-blue-600" href="/history">Order history</a> tab!
                    <br>
                    <p><b>Risk only the capital you can afford to lose! No one from the staff will ever ask for your credentials!</b></p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
