<?php
/**
 * This is the view file for Client/Index
 */

?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pb-2">
            <base-btn
                tag="a"
                href="/clients/create"
                title="Add a new client"
                iconClasses="oi oi-plus"
                text="Add new client"
            ></base-btn>
        </div>
        <clients-table v-bind:clients="{{ json_encode($clients->items()) }}"></clients-table>
        {{ $clients->links() }}

    </div>
@endsection
