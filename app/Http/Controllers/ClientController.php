<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('clients.index');
    }

    public function data(Request $request){
        $pageNumber = $request->input('pageNumber');
        $offset = $pageNumber == 1 ? null : ($pageNumber - 1) * 10;

        $total = Client::count();
        $clients = Client::limit(10)
                         ->when($offset, fn ($q) => $q->offset($offset))
                         ->get()
                         ->toArray();

        return response()->json([
            'total' => $total,
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $client = new Client();
        $client->first_name = $request->input('first_name');
        $client->last_name  = $request->input('last_name');
        //fix shenanigans
        $client->avatar = str_replace(
            'public',
            'storage',
            $request->file('avatar')->store('public')
        );
        $client->email = $request->input('email');
        $client->save();

        return redirect()->route('clients.index')->with([
            'message'=> 'Client successfully created!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return response()->view('clients.show', [
            'client' => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return response()->view('clients.edit', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->first_name = $request->input('first_name');
        $client->last_name = $request->input('last_name');
        $client->email      = $request->input('email');

        if ($file = $request->file('avatar')){
            $client->avatar = $file->store('public');
        }

        $client->save();

        return back()->with([
            'message' => 'Client updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
    }
}
