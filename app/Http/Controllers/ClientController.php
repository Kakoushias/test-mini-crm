<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Repositories\ClientReadRepository;
use App\Repositories\ClientWriteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function __construct(
        protected ClientWriteRepository $writeRepo,
        protected ClientReadRepository $readRepo
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('clients.index');
    }

    public function data(Request $request)
    {
        $pageNumber = $request->input('pageNumber');
        $offset     = $pageNumber == 1
            ? 0
            : ($pageNumber - 1) * 10;

        $total   = $this->readRepo->count();
        $clients = $this->readRepo->get(10, $offset)
                                  ->toArray();

        return response()->json([
            'total'   => $total,
            'clients' => $clients,
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
     * @param \App\Http\Requests\StoreClientRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $this->writeRepo->store(
            $request->input('first_name'),
            $request->input('last_name'),
            $request->file('avatar')->store('public'),
            $request->input('email')
        );

        return redirect()->route('clients.index')->with([
            'message' => 'Client successfully created!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Client $client
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return response()->view('clients.show', [
            'client' => $client->load(['transactions']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Client $client
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return response()->view('clients.edit', [
            'client' => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateClientRequest $request
     * @param \App\Models\Client $client
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $filePath = $request->file('avatar')
            ?
            $request->file('avatar')->store('public')
            :
            $client->avatar;

        $this->writeRepo->update(
            $client,
            $request->input('first_name'),
            $request->input('last_name'),
            $filePath,
            $request->input('email')
        );

        return back()->with([
            'message' => 'Client updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Client $client
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
    }
}
