@extends('layouts.app')

@section('javascript')
@vite(['resources/js/dashboard.js'])
@endsection

@section('content')
    <div class="container dashboard">

        <div class="row">
            <div class="col">
                <h1 class="fs-1 text-dark-emphasis my-4 text-center fw-bolder badge_special">
                    {{ __('La tua Dashboard, ') . Auth::user()->first_name }} 
                </h1>
            </div>
        </div>



        <div class=" justify-content-center">
            <div class="row">
                <div class="col-sm-12 col-lg-6 d-flex flex-wrap">
                    <div id="card_off_interval" class="card card_bg_special w-100 mb-4">{{-- dashboard card --}}

                        <div class="card-header text-center text-uppercase p-2">
                            <h2 class="fw-bolder m-0 text-secondary">{{ __('Stato') }}</h2>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center p-2">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <h3>{{ __('Accesso effettuato!') }}</h3>
                            
                        </div>
                    </div>
                    <div class="card card_bg_special mb-4">{{-- operations card --}}
                        <div class="card-header text-center text-uppercase p-2">
                            <h2 class="fw-bolder m-0 text-secondary">{{__('Operazioni')}}</h2>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <p class="operations_description">{{__('Mantieni aggiornata la tua dashboard, accedi alla pagina dei tuoi annunci, aggiungine di nuovi o elimina quelli obsoleti!')}}</p>
                        </div>
                        <div class="card-footer ">
                            <div class="row d-flex justify-content-around">


                                <a class="col-5 btn btn-dark text-uppercase d-flex justify-content-center align-items-center" href="{{ route('admin.apartments.index') }}"
                                    role="button">{{__('Vedi annunci')}}</a>

                                <a class="col-5 btn btn-dark text-uppercase d-flex justify-content-center align-items-center" href="{{ route('admin.apartments.create') }}"
                                    role="button">{{__('Inserisci annuncio')}}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-6">
                    <div class="card card_bg_special mb-4">{{-- statistics card --}}
                        <div class="card-header text-center">
                            <h2 class="fw-bolder m-0 text-secondary text-uppercase">{{__('le tue statistiche')}}</h2>

                        </div>
                        <div class="card-body">
                            <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
                        </div>
                        {{-- <div class="card-footer">
                            footer
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
