@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pb-2">
            <h2>
                {{ __('Transactions') }}
                <div class="d-inline float-right">
                    <base-btn
                        tag="a"
                        href="/clients/create"
                        size="sm"
                        title="Add a new transaction"
                        icon-classes="oi oi-plus"
                        text="Add new transaction"
                    ></base-btn>
                </div>
            </h2>
        </div>
        <transactions-table v-bind:transactions="{{ json_encode($transactions->items()) }}"></transactions-table>
        {{ $transactions->links('pagination::bootstrap-4') }}

    </div>
@endsection
