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

                    <form name="update-client" enctype="multipart/form-data" id="update-client" method="POST" action="{{route('clients.update', ['client' => $client->id])}}">
                        @method('PUT')
                        @csrf
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <label for="first_name">First Name:</label>
                            <input required type="text" id="first_name" name="first_name" value="{{$client->first_name}}">
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <label for="last_name">Last Name:</label>
                            <input required type="text" id="last_name" name="last_name" value="{{$client->last_name}}">
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <label for="avatar">Avatar:</label>
                            <div>
                                <img src="{{$client->getAvatar()}}" alt="Image"></img>
                                <input type="file"  id="avatar" name="avatar">
                            </div>
                        </div>
                        <div class="py-2 grid grid-cols-2 gap-4">
                            <label for="email">Email:</label>
                            <input required type="email" id="email" name="email" value="{{$client->email}}">
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
