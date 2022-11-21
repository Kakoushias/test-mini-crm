<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-3xl py-2 text-center font-bold">Transaction {{$transaction->id}}</h1>
                <div class="p-6 text-gray-900">
                    @if(session()->has('message'))
                        <div class="bg-green-300 p-2 alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="bg-red-300">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <form name="update-transaction" enctype="multipart/form-data" name="update-transaction" method="POST" action="{{route('transactions.update', ['transaction' => $transaction->id])}}">
                        @method('PUT')
                        @csrf
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <label for="first_name">Amount:</label>
                            <input required type="number" id="amount" min="0" value="{{$transaction->amount}}" step="0.01" name="amount">
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <label for="transaction_date">Transaction Date:</label>
                            <input required type="datetime-local" id="transaction_date" name="transaction_date" value="{{$transaction->transaction_date}}">
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <label for="client_id">Client ID:</label>
                            <input required type="number" min="1" id="client_id"  value={{$transaction->client_id}} name="client_id">
                        </div>
                        <div class="pt-4 text-right">
                            <button class="text-white bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
