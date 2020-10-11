<?php
/**
 * This is the view file for Client/Index
 */

?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pb-2">
            <h2>{{ __('Create new client') }}</h2>
            <hr>
        </div>
        <div class="justify-content-center d-flex">
            <client-form
                form-action="{{ @route('clients.store') }}"
                form-method="post"
                default-avatar="{{ asset('storage/avatars/default-avatar.png') }}"
            ></client-form>
        </div>
    </div>
@endsection
