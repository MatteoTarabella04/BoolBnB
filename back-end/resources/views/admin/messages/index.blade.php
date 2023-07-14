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
            <h1 class="page_title fs-1 text-dark-emphasis my-4 text-center fw-bolder badge_special">
                {{ __('Messaggi ricevuti') }}</h1>
            <div class="row">
                @forelse($messages as $message)
                    <div class="col-12 d-flex align-items-center flex-wrap rounded-1 m-1">
                        <div class="col-12 col-sm-6 col-md-8 p-3 d-flex gap-4 align-items-start align-items-md-center">
                            <span class="text-dark">
                                @if ($message->seen)
                                    <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M64 208.1L256 65.9 448 208.1v47.4L289.5 373c-9.7 7.2-21.4 11-33.5 11s-23.8-3.9-33.5-11L64 255.5V208.1zM256 0c-12.1 0-23.8 3.9-33.5 11L25.9 156.7C9.6 168.8 0 187.8 0 208.1V448c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V208.1c0-20.3-9.6-39.4-25.9-51.4L289.5 11C279.8 3.9 268.1 0 256 0z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                    </svg>
                                @endif
                            </span>
                            <div>
                                <h3>
                                    <strong>Nome mittente: </strong>{{ $message->full_name }}
                                </h3>
                                <h6><strong>Data messaggio: </strong>{{ $message->send_date }}</h6>
                                <div class="index_buttons">
                                    <div class="d-flex justify-content-start flex-wrap align-items-center gap-3">
                                        <a class="btn btn-light strong_shadow"
                                            href="{{ route('admin.messages.show', $message) }}">
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
                                        <!-- Modal trigger button -->
                                        <button type="button" class="btn btn-dark my-2 strong_shadow "
                                            data-bs-toggle="modal" data-bs-target="#modalId-{{ $message->id }}">
                                            <span class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash3-fill vertical_align_text_top"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                </svg>
                                            </span>
                                            <span class="text_from_left">Elimina</span>
                                        </button>

                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div class="modal fade text-black" id="modalId-{{ $message->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitleId-{{ $message->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitle-{{ $message->id }}">
                                                            Eliminare messaggio da
                                                            {{ $message->full_name }}?
                                                        </h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-dark"
                                                            data-bs-dismiss="modal">Chiudi</button>
                                                        <form action="{{ route('admin.messages.destroy', $message->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Elimina</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 p-3">
                            @if ($message->seen)
                                <img height="200" src="{{ asset('storage/' . $message->apartment->image) }}"
                                    alt="Immagine {{ $message->apartment->name }}"
                                    class="w-100 object-fit-cover rounded-3 strong_shadow opacity-50">
                            @else
                                <img height="200" src="{{ asset('storage/' . $message->apartment->image) }}"
                                    alt="Immagine {{ $message->apartment->name }}"
                                    class="w-100 object-fit-cover rounded-3 strong_shadow">
                            @endif
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
