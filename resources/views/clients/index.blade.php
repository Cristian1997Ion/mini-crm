<?php
/**
 * This is the view file for Client/Index
 */

?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pb-2">
            <h2>
                {{ __('Clients') }}
                <div class="d-inline float-right">
                    <base-btn
                        tag="a"
                        href="/clients/create"
                        size="sm"
                        title="Add a new client"
                        icon-classes="oi oi-plus"
                        text="Add new client"
                    ></base-btn>
                </div>
            </h2>
        </div>
        <clients-table
            v-bind:clients="{{ json_encode($clients->items()) }}"
            @if(!empty($filters['id']))
                v-bind:id-filter="'{{ $filters['id'] }}'"
            @endif
            @if(!empty($filters['name']))
                v-bind:name-filter="'{{ $filters['name'] }}'"
            @endif
            @if(!empty($filters['email']))
                v-bind:email-filter="'{{ $filters['email'] }}'"
            @endif
        ></clients-table>
        {{ $clients->links('pagination::bootstrap-4') }}

    </div>
@endsection
