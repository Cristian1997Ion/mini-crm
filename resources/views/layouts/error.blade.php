@extends('layouts.app')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger text-light">
                    <span>Error</span>
                </div>
                <div class="card-body">
                    <p>{{ $error }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
