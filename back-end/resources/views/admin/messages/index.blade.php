@extends('layouts.app')

@section('content')
<section class="messages">
    <div class="bg_double_show body_minus_header_block"></div>

    <div class="container">
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <h1 class="page_title fs-1 text-dark-emphasis my-4 text-center fw-bolder badge_special">{{ __('Messaggi ricevuti') }}</h1>
        <div class="row">
            @forelse($messages as $message)
                <div class="col-12 d-flex align-items-center flex-wrap rounded-1 m-1">
                    <div class="col-12 col-sm-6 col-md-8 p-3 d-flex flex-column justify-content-center">
                        <h3><strong>Nome mittente: </strong>{{ $message->full_name }}</h3>
                        <h6><strong>Data messaggio: </strong>{{ $message->send_date }}</h6>
                        <div class="index_buttons">
                            <div class="d-flex justify-content-start justify-content-sm-center justify-content-md-start flex-wrap flex-sm-column flex-md-row">
                                <a class="btn me-2 my-2 btn-light strong_shadow" href="{{ route('admin.messages.show', $message) }}">
                                    <span class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill vertical_align_text_top" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                        </svg>
                                    </span>
                                    <span class="text_from_left">Leggi</span>
                                </a>
                                <form action="{{ route('admin.messages.destroy', $message) }}" method="post" class="text-center ">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-dark my-2 strong_shadow" type="submit">
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill vertical_align_text_top" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                        </span>
                                        <span class="text_from_left">Elimina</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 p-3">
                        <img height="200" src="{{ asset('storage/' . $message->apartment->image) }}" alt="Immagine {{ $message->apartment->name }}" class="w-100 object-fit-cover rounded-3 strong_shadow">
                    </div>
                </div>
                <hr>
            @empty
                <div class="col">
                    <h3 class="text-center">Non ci sono messaggi ricevuti</h3>
                </div>
            @endforelse
        </div>
    </div>
@endsection
