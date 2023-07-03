@extends('layouts.app')

@section('content')
<div class="container">


    <div class="d-flex justify-content-between align-items-center">

        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        
        <a class="btn btn-primary" href="{{ route('admin.apartments.index') }}" role="button">Vedi appartamenti</a>

        
    </div>


    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                
                <div class="card-header">{{ __('User Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
