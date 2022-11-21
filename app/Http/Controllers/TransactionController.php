<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Repositories\TransactionReadRepository;
use App\Repositories\TransactionWriteRepository;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionReadRepository $readRepo,
        protected TransactionWriteRepository $writeRepo
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transactions.index', [
            'transactions' => $this->readRepo->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreTransactionRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $this->writeRepo->store(
            floatval($request->input('amount')),
            $request->input('client_id'),
            Carbon::parse($request->input('transaction_date'))
        );

        return redirect()->route('transactions.index')->with([
            'message' => 'Transaction successfully created!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Transaction $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', [
            'transaction' => $transaction->load(['client' => fn($q) => $q->withTrashed()]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Transaction $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateTransactionRequest $request
     * @param \App\Models\Transaction $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $this->writeRepo->update(
            $transaction,
            floatval($request->input('amount')),
            $request->input('client_id'),
            Carbon::parse($request->input('transaction_date'))
        );

        return back()->with([
            'message' => 'Transaction updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Transaction $transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with(['message' => 'Transaction deleted successfully']);
    }
}
