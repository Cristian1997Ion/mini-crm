@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pb-2">
            <h2>
                {{ __('Transactions') }}
                <div class="d-inline float-right">
                    <base-btn
                        tag="a"
                        href="{{@route('transactions.create')}}"
                        size="sm"
                        title="Add a new transaction"
                        icon-classes="oi oi-plus"
                        text="Add new transaction"
                    ></base-btn>
                </div>
            </h2>
        </div>
        <transactions-table
            v-bind:transactions="{{ json_encode($transactions->items()) }}"
            @if(!empty($filters['id']))
                v-bind:id-filter="'{{ $filters['id'] }}'"
            @endif
            @if(!empty($filters['client']))
                v-bind:client-filter="'{{ $filters['client'] }}'"
            @endif
            @if(!empty($filters['amount']))
                v-bind:amount-filter="'{{ $filters['amount'] }}'"
            @endif
            @if(!empty($filters['created']))
                v-bind:created-filter="'{{ $filters['created'] }}'"
            @endif
        ></transactions-table>
        {{ $transactions->links('pagination::bootstrap-4') }}

    </div>
@endsection
