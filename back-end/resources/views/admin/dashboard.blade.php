@extends('layouts.app')

@section('javascript')
    @vite(['resources/js/dashboard.js'])
@endsection

@section('content')
    <div class="container dashboard">

        <div class="bg_double_show body_minus_header_block"></div>
        <h1 class="fs-1 text-dark-emphasis my-4 text-center fw-bolder page_title">{{ __('Dashboard') }}</h1>
        <div class=" justify-content-center">
            <div class="row">
                <div class="col-sm-12 col-lg-6 d-flex flex-wrap">
                    <div id="card_off_interval" class="card card_bg_special w-100 mb-4">{{-- dashboard card --}}
                        <div class="card-header text-center p-2">
                            <h2 class="fw-bolder m-0 text-secondary">{{ __('LOGIN EFFETTUATO!') }}</h2>
                        </div>
                        <div class="card-body transition_duration_1 d-flex align-items-center justify-content-center p-2">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <h3>{{ __('Bentornato ' . Auth::user()->first_name) }}</h3>

                        </div>
                    </div>
                    <div class="card card_bg_special mb-4">{{-- operations card --}}
                        <div class="card-header text-center text-uppercase p-2">
                            <h2 class="fw-bolder m-0 text-secondary">{{ __('Operazioni') }}</h2>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <p class="operations_description">
                                {{ __('Mantieni aggiornata la tua dashboard, accedi alla pagina dei tuoi annunci, aggiungine di nuovi o elimina quelli obsoleti!') }}
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="row d-flex justify-content-around">


                                <a class="col-5 btn btn-dark text-uppercase d-flex justify-content-center align-items-center"
                                    href="{{ route('admin.apartments.index') }}" role="button">{{ __('Vedi annunci') }}</a>

                                <a class="col-5 btn btn-dark text-uppercase d-flex justify-content-center align-items-center"
                                    href="{{ route('admin.apartments.create') }}"
                                    role="button">{{ __('Inserisci annuncio') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-6">
                    <div class="card card_bg_special mb-4">{{-- statistics card --}}
                        <div class="card-header text-center">
                            <h2 class="fw-bolder m-0 text-secondary text-uppercase">{{ __('LE TUE STATISTICHE') }}</h2>

                        </div>
                        <div class="card-body" style="width: 100%; max-width: 700px; margin-inline: auto">
                            <canvas id="myChart"></canvas>
                        </div>
                        {{-- <div class="card-footer">
                            footer
                        </div> --}}
                    </div>
                </div>
            </div>
            <div id="latest_messages">
                <div class="card card_bg_special w-100 mb-4">
                    <div class="card-header text-center p-3">
                        <h2 class="fw-bolder m-0 text-secondary">{{ __('MESSAGGI DA LEGGERE') }}</h2>
                    </div>
                    <div class=" card-body p-0">
                        <ul class="list-group list-unstyled rounded-0">
                            @if (count($sortedUnreadMessages) >= 3)
                                @for ($i = 0; $i < 3; $i++)
                                    <li
                                        class="list-group-item d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                                        <div>
                                            <h5 class="mb-3"><strong>Da:
                                                </strong>{{ $sortedUnreadMessages[$i]->full_name }}</h5>
                                            <h5 class="mb-0"><strong>Messaggio:
                                                </strong>{{ $sortedUnreadMessages[$i]->content }}</h5>
                                        </div>
                                        <a class="btn btn-light strong_shadow"
                                            href="{{ route('admin.messages.show', $sortedUnreadMessages[$i]) }}">
                                            <span class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-eye-fill vertical_align_text_top"
                                                    viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                    <path
                                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                </svg>
                                            </span>
                                            <span class="text_from_left">Leggi</span>
                                        </a>
                                    </li>
                                @endfor
                            @elseif(count($sortedUnreadMessages) >= 1)
                                @for ($i = 0; $i < count($sortedUnreadMessages); $i++)
                                    <li
                                        class="list-group-item d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                                        <div>
                                            <h5 class="mb-3"><strong>Da:
                                                </strong>{{ $sortedUnreadMessages[$i]->full_name }}</h5>
                                            <h5 class="mb-0"><strong>Messaggio:
                                                </strong>{{ $sortedUnreadMessages[$i]->content }}</h5>
                                        </div>
                                        <a class="btn btn-light strong_shadow"
                                            href="{{ route('admin.messages.show', $sortedUnreadMessages[$i]) }}">
                                            <span class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-eye-fill vertical_align_text_top"
                                                    viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                    <path
                                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                </svg>
                                            </span>
                                            <span class="text_from_left">Leggi</span>
                                        </a>
                                    </li>
                                @endfor
                            @else
                                <li class="list-group-item">
                                    <h4 class="mb-0 text-center py-3">
                                        <strong>{{ __('Non hai messaggi da leggere') }}</strong>
                                    </h4>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-footer text-center p-3">
                        <a class="btn btn-dark strong_shadow" href="{{ route('admin.messages.index') }}">
                            <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="currentColor"
                                    viewBox="0 0 512 512" class="vertical_align_sub">
                                    <path
                                        d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                </svg>
                            </span>
                            <span class="text_from_left">Messaggi ricevuti</span>

                            @if (count($sortedUnreadMessages) > 0)
                                <span
                                    class="position-absolute text-dark top-0 start-100 translate-middle badge rounded-pill bg_special p-2">
                                    {{ count($sortedUnreadMessages) }}
                                    <span class="visually-hidden">unread messages</span>
                            @endif
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
