@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pb-2">
            <h2>{{ __('Edit client\'s info') }}</h2>
            <hr>
        </div>
        <div class="justify-content-center d-flex">
            <client-form
                form-action="{{ @route('clients.store') }}"
                form-method="post"
                avatar="{{ asset('storage/avatars/default-avatar.png') }}"
                :client="{{ json_encode($client) }}"
                @if ($errors->any())
                    :errors="{{json_encode($errors->all())}}"
                @endif
            ></client-form>
        </div>
    </div>
@endsection
