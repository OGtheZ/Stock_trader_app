<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Portfolio
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <p class="font-bold">At this time the website accepts only U.S. Dollars $.</p>

        <div class="mt-2">
            <form class="inline" action="/addFunds" method="post">
                @csrf
                @error("amount")
                <p class="text-red-600 font-bold mt-2">{{ $message }}</p>
                @enderror
                <div class="mb-2"><label for="amount">Amount $ : </label>
                    <br>
                    <input class="rounded" type="text" name="amount" id="amount" >
                </div>

                <p class="font-bold mb-2">Billing information:</p>
                <div class="mb-2">
                    @error("name")
                    <p class="text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    <label for="name">First name :</label>
                    <br>
                    <input class="rounded" type="text" name="name" id="name">
                </div>
                <div class="mb-2">
                    @error("lastName")
                    <p class="text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    <label for="lastName">Last name :</label>
                    <br>
                    <input class="rounded" type="text" name="lastName" id="lastName">
                </div>
                <div class="mb-2">
                    @error("address")
                    <p class="text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    <label for="address">Address :</label>
                    <br>
                    <input class="rounded" type="text" name="address" id="address">
                </div>
                <div class="mb-2">
                    @error("ccNumber")
                    <p class="text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    <label for="ccNumber">Credit card number :</label>
                    <br>
                    <input class="rounded" type="text" name="ccNumber" id="ccNumber" value="{{ old('ccNumber') }}">
                </div>
                <div class="mb-2">
                    @error("ccExp")
                    <p class="text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    <label for="ccExp">Credit card expiration :</label>
                    <br>
                    <input class="rounded" type="text" name="ccExp" id="ccExp">
                </div>
                <div class="mb-2">
                    @error("cvv")
                    <p class="text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    <label for="cvv">CVV :</label>
                    <br>
                    <input class="rounded" type="text" name="cvv" id="cvv">
                </div>
                <br>
                <button class="border p-1.5 border-black rounded hover:bg-gray-300" type="submit">Add funds</button>
                <img class="mx-auto my-auto" src="https://www.waveswifi.com/sites/default/files/visa-mastercard-amex_0.png" alt="CCs image">
            </form>

        </div>



    </div>
</x-app-layout>
