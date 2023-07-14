@extends('layouts.app')

@section('content')
    <div>
        <div class="bg_double_show body_minus_header_block"></div>

        <div class="container py-5 px-2 rounded-4">
            <a class="btn btn-dark strong_shadow" href="{{ route('admin.messages.index') }}">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="currentColor"
                        viewBox="0 0 512 512" class="vertical_align_sub">
                        <path
                            d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                    </svg>
                </span>
                <span class="text_from_left">Ritorna ai messaggi ricevuti</span>
            </a>

            <div class="info_container mt-4 d-flex justify-content-center flex-wrap">
                <div
                    class="mt-2 mt-md-0 col-12 col-md-6 col-lg-8 d-flex flex-column align-items-start justify-content-center">
                    <h2 class="fw-bold mb-0">Nome mittente:<p class="fw-medium mb-0 mt-2">{{ $message->full_name }}</p>
                    </h2>
                    <hr class="w-100">
                    <h4 class="fw-bold mb-0">Testo messaggio:<p class="fw-medium mb-0 mt-2">{{ $message->content }}</p>
                    </h4>
                    <hr class="w-100">
                    <h4 class="fw-bold mb-0">E-mail mittente:<a href="mailto:{{ $message->sender_email }}"
                            class="fw-medium d-block mb-0 mt-2" style="color: #c9b7b0">{{ $message->sender_email }}</a></h4>
                    <hr class="w-100">
                    <h5 class="fw-medium mb-3"><strong>Data messaggio:</strong><br>{{ $message->send_date }}</h5>
                    <div class="d-flex justify-content-start flex-wrap">
                        <!-- Modal trigger button -->
                        <button type="button" class="btn btn-dark my-2 strong_shadow " data-bs-toggle="modal"
                            data-bs-target="#modalId-{{ $message->id }}">
                            <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3-fill vertical_align_text_top" viewBox="0 0 16 16">
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
                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Chiudi</button>
                                        <form action="{{ route('admin.messages.destroy', $message->id) }}" method="post">
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
                <div
                    class="image mt-4 mt-md-0 col-12 col-md-6 col-lg-4 ps-md-4 d-flex justify-content-center align-items-center flex-column ">
                    <img src="{{ asset('storage/' . $message->apartment->image) }}"
                        class="rounded-4 strong_shadow object-fit-cover"
                        style="width: 100%; max-width:500px; aspect-ratio: 12 / 9"
                        alt="Immagine {{ $message->apartment->name }}">
                </div>
            </div>
        </div>
    </div>
@endsection
