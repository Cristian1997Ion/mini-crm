<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

/**
 * Class TransactionController
 * @package App\Http\Controllers
 */
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with('client');

        if ($id = \request()->get('id', false)) {
            $transactions->where('id', '=', $id);
        }

        if ($client = \request()->get('client', false)) {
            $transactions->where('client_id', '=', $client);
        }

        if ($amount = \request()->get('amount', false)) {
            $transactions->where('amount', 'LIKE', "{$amount}%");
        }

        if ($created = \request()->get('created', false)) {
            $transactions->where('created_at', 'LIKE', "{$created}%");
        }


        $transactions = $transactions->orderByDesc('id')->paginate(10);
        return response()->view(
            'transactions.index',
            [
                'transactions' => $transactions->appends(\request()->input()),
                'filters'      => [
                    'id'      => $id,
                    'client'  => $client,
                    'amount'  => $amount,
                    'created' => $created,
                ]
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'amount' => 'required',
        ]);

        if (!$transaction = Transaction::find($request->post('id', 0))) {
            $transaction = new Transaction();
        }

        $transaction->client_id = $request->post('client_id');
        $transaction->amount    = $request->post('amount');

        $transaction->save();

        return response()->redirectTo(@route('transactions.edit', $transaction->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$transaction = Transaction::with('client')->find($id)) {
            return response()->view('layouts.error', ['error' => 'Transaction not found!']);
        }

        return response()->view('transactions.edit', ['transaction' => $transaction]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        if ($transaction = Transaction::find($id)) {
            $transaction->delete();
        }
    }
}
