@extends('layouts.app')

@section('content')
    <div class="container dashboard">

        <div class="row">
            <div class="col">
                <h1 class="fs-1 text-dark-emphasis my-4 text-center fw-bolder badge_special">
                    {{ __('La tua Dashboard, "Nome"') }}
                </h1>
            </div>
        </div>



        <div class=" justify-content-center">
            <div class="row">
                <div class="col-6 d-flex flex-wrap">
                    <div class="card card_bg_special w-100 mb-4">{{-- dasboard card --}}

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
                    <div class="card card_bg_special mb-4">{{-- operations card --}}
                        <div class="card-header text-center text-uppercase p-2">
                            <h2 class="fw-bolder m-0 text-secondary">operazioni</h2>
                        </div>
                        <div class="card-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea nihil mollitia earum, vel
                                accusantium ratione, inventore facere magni maxime nesciunt eum hic tempore. Voluptate
                                excepturi minima, error mollitia voluptatum aliquam architecto vitae dolor nam dignissimos.
                                Harum optio reiciendis blanditiis, sit possimus iure hic dolore in quidem dolor, nostrum
                                quibusdam nobis!</p>
                        </div>
                        <div class="card-footer ">
                            <div class="row d-flex justify-content-around">


                                <a class="col-5 btn btn-dark text-uppercase" href="{{ route('admin.apartments.index') }}"
                                    role="button">Vedi annunci</a>

                                <a class="col-5 btn btn-dark text-uppercase" href="{{ route('admin.apartments.create') }}"
                                    role="button">Inserisci annuncio</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card card_bg_special">{{-- statistics card --}}
                        <div class="card-header text-center">
                            <h2 class="fw-bolder m-0 text-secondary">LE TUE STATISTICHE</h2>

                        </div>
                        <div class="card-body">
                            body
                        </div>
                        <div class="card-footer">
                            footer
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
