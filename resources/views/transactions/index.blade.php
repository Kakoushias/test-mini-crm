<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if(session()->has('message'))
                    <div class="bg-green-300 p-2 alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                    <h1 class="text-3xl text-center font-bold">Transactions</h1>
                    <div class="pl-8 py-2 -px-2 overflow-auto relative">
                        <a href="/transactions/create">
                            <button class="text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Create New Transaction</button>
                        </a>
                    </div>

                <div class="p-2 text-gray-900">
                    <table class="table-auto shadow-lg bg-white" style="width: 100%">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="text-left px-8 py-4">ID</th>
                            <th class="text-left px-8 py-4">Client</th>
                            <th class="text-left px-8 py-4">Amount</th>
                            <th class="text-left px-8 py-4">Transaction Date</th>
                            <th class="text-right py-4">Actions</th>
                            <th class="text-left py-4"></th>
                            <th class="text-left py-4"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($transactions as $transaction)
                            <tr class="hover:bg-stone-100" >
                                <td class="text-left px-8 py-4">{{ $transaction->id }}</td>
                                <td class="text-left px-8 py-4">{{ $transaction->client->fullName()}}</td>
                                <td class="text-left px-8 py-4">{{ $transaction->amount }}</td>
                                <td class="text-left px-8 py-4">{{ $transaction->transaction_date }}</td>
                                <td class="text-left">
                                    <a href="{{route('transactions.show', ['transaction' => $transaction->id])}}">
                                        <button class="text-white bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Show</button>
                                    </a>
                                </td>
                                <td class="text-left">
                                    <a href="{{route('transactions.edit', ['transaction' => $transaction->id])}}">
                                        <button class="text-white bg-orange-300 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Edit</button>
                                    </a>
                                </td>
                                <td class="text-left">
                                    <form method="POST" action="{{route('transactions.destroy', ['transaction' => $transaction->id])}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-400 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">There are no transactions.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="pt-6">
                        {!! $transactions->withQueryString()->links() !!}
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

