@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pb-2">
            <h2>{{ __('Edit transaction') }}</h2>
            <hr>
        </div>
        <div class="justify-content-center d-flex">
            <transaction-form
                form-action="{{ @route('transactions.store') }}"
                form-method="post"
                :transaction="{{ json_encode($transaction) }}"
                @if ($errors->any())
                :errors="{{json_encode($errors->all())}}"
                @endif
            ></transaction-form>
        </div>
    </div>
@endsection
