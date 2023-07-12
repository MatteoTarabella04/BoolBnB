@extends('layouts.app')

@section('content')
    <div>
        <div class="bg_double_show body_minus_header_block"></div>

        <div class="container py-5 px-2 rounded-4">
            <a class="btn btn-dark strong_shadow" href="{{ route('admin.messages.index') }}">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z" />
                    </svg>
                </span>
                <span class="text_from_left">Ritorna ai messaggi ricevuti</span>
            </a>

            <div class="info_container mt-4 d-flex justify-content-center flex-wrap">
                <div class="mt-2 mt-md-0 col-12 col-md-6 col-lg-8 d-flex flex-column align-items-start justify-content-center">
                    <h1 class="fw-bold mb-0">Nome mittente:<p class="fw-medium mb-0 mt-2">{{ $message->full_name }}</p></h1>
                    <hr class="w-100">
                    <h3 class="fw-bold mb-0">Testo messaggio:<p class="fw-medium mb-0 mt-2">{{ $message->content }}</p></h3>
                    <hr class="w-100">
                    <h3 class="fw-bold mb-0">E-mail mittente:<a href="mailto:{{ $message->sender_email }}" class="fw-medium d-block mb-0 mt-2" style="color: #c9b7b0">{{ $message->sender_email }}</a></h3>
                    <hr class="w-100">
                    <p class="fw-medium mb-3"><strong>Data messaggio:</strong><br>{{ $message->send_date }}</p>
                    <div class="d-flex justify-content-start flex-wrap">
                        <form action="{{ route('admin.messages.destroy', $message) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-dark shadow" type="submit">
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                    </svg>
                                </span>
                                <span class="text_from_left">Elimina</span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="image mt-4 mt-md-0 col-12 col-md-6 col-lg-4 ps-md-4 d-flex justify-content-center align-items-center flex-column ">
                    <img src="{{ asset('storage/' . $message->apartment->image) }}" class="rounded-4 strong_shadow object-fit-cover" style="width: 100%; max-width:500px; aspect-ratio: 12 / 9" alt="Immagine {{ $message->apartment->name }}">
                </div>
            </div>
        </div>
    </div>
@endsection
