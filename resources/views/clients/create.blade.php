<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-3xl py-2 text-center font-bold">Create Client</h1>
                <div class="p-6 text-gray-900">
                    <div class="bg-red-300">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <form name="create-client" enctype="multipart/form-data" id="create-client" method="post" action="{{route('clients.store')}}">
                        @csrf
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <label for="first_name">First Name:</label>
                            <input required type="text" id="first_name" name="first_name">
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <label for="last_name">Last Name:</label>
                            <input required type="text" id="last_name" name="last_name">
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <label for="avatar">Avatar:</label>
                            <input required type="file"  id="avatar" name="avatar">
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <label for="email">Email:</label>
                            <input required type="email" id="email" name="email">
                        </div>
                        <div class="pt-4 text-right">
                            <button class="text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-400 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
