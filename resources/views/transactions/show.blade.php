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
                    <div class="py-2 grid grid-cols-2 gap-4">
                        <label for="first_name">Amount:</label>
                        <span>{{$transaction->amount}}</span>
                    </div>
                    <div class="py-2 grid grid-cols-2 gap-4">
                        <label for="last_name">Transaction Date:</label>
                        <span>{{$transaction->transaction_date}}</span>
                    </div>
                    <div class="py-2 grid grid-cols-2 gap-4">
                        <label for="avatar">Client:</label>
                        <a href="{{route('clients.show', ['client'=> $transaction->client_id])}}" @if(!empty($transaction->client->deleted_at)) style="pointer-events: none;" @endif>{{$transaction->client->fullName()}}</a>
                    </div>
                    <div class="py-2 grid grid-cols-2 gap-4">
                        <label for="email">Created At:</label>
                        <span>{{$transaction->created_at}}</span>
                    </div>
                    <div class="py-2 grid grid-cols-2 gap-4">
                        <label for="email">Updated At:</label>
                        <span>{{$transaction->updated_at}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
