<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-3xl py-2 text-center font-bold">{{$client->fullName()}}</h1>
                <div class="p-6 text-gray-900">
                    <div class="py-2 grid grid-cols-2 gap-4">
                        <label for="first_name">First Name:</label>
                        <span>{{$client->first_name}}</span>
                    </div>
                    <div class="py-2 grid grid-cols-2 gap-4">
                        <label for="last_name">Last Name:</label>
                        <span>{{$client->last_name}}</span>
                    </div>
                    <div class="py-2 grid grid-cols-2 gap-4">
                        <label for="avatar">Avatar:</label>
                        <img src="{{$client->getAvatar()}}" alt="Image"></img>
                    </div>
                    <div class="py-2 grid grid-cols-2 gap-4">
                        <label for="email">Email:</label>
                        <span>{{$client->email}}</span>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-3xl py-2 text-center font-bold">Transactions</h1>
                <div class="pb-5">
                    <div class="p-2">
                        <table class="table-auto shadow-lg bg-white" style="width: 100%">
                            <thead class="bg-gray-100">
                            <th class="text-left px-8 py-4">ID</th>
                            <th class="text-left px-8 py-4">Amount</th>
                            <th class="text-left px-8 py-4">Transaction Date</th>
                            <th class="text-left px-8 py-4">Created At</th>
                            <th class="text-left px-8 py-4">Updated At</th>
                            </thead>
                            <tbody>
                            @forelse($client->transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->id}}</td>
                                    <td>{{$transaction->amount}}</td>
                                    <td>{{$transaction->transaction_date}}</td>
                                    <td>{{$transaction->created_at}}</td>
                                    <td>{{$transaction->updated_at}}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="3">There are no transactions</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
