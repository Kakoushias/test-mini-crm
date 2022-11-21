<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
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

                <div class="p-2 text-gray-900">
                    <clients></clients>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

