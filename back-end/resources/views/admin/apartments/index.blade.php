@extends('layouts.app')

@section('content')
    <section>
        <div class="bg_double_show body_minus_header_block"></div>
        <div class="container pt-3">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h1 class="fw-bold text-dark-emphasis page_title">I tuoi annunci</h1>
            <div class="d-flex justify-content-end my-4">
                <a class="btn bg_special text-end strong_shadow" href="{{ route('admin.apartments.create') }}">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-lg vertical_align_text_top" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                        </svg>
                    </span>
                    <span class="text_from_left" style="margin: 10px 0 5px 0;">Inserisci annuncio</span></a>
            </div>
            <div class="row">
                @forelse($apartments as $apartment)
                    <div class="col-12 d-flex align-items-center flex-wrap rounded-1">
                        <div class="col-12 col-sm-6 col-md-4 my-3 position-relative">
                            <img src="{{ asset('storage/' . $apartment->image) }}" alt="Immagine {{ $apartment->name }}"
                                class="w-100 rounded-3 strong_shadow image_aspect_ratio">
                            @if ($apartment->hasSponsorization)
                                <div class="sponsorization_badge">
                                    <svg fill="#ffc107" xmlns="http://www.w3.org/2000/svg" width="10%"
                                        viewBox="0 0 576 512">
                                        <path
                                            d="M309 106c11.4-7 19-19.7 19-34c0-22.1-17.9-40-40-40s-40 17.9-40 40c0 14.4 7.6 27 19 34L209.7 220.6c-9.1 18.2-32.7 23.4-48.6 10.7L72 160c5-6.7 8-15 8-24c0-22.1-17.9-40-40-40S0 113.9 0 136s17.9 40 40 40c.2 0 .5 0 .7 0L86.4 427.4c5.5 30.4 32 52.6 63 52.6H426.6c30.9 0 57.4-22.1 63-52.6L535.3 176c.2 0 .5 0 .7 0c22.1 0 40-17.9 40-40s-17.9-40-40-40s-40 17.9-40 40c0 9 3 17.3 8 24l-89.1 71.3c-15.9 12.7-39.5 7.5-48.6-10.7L309 106z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div
                            class="col-12 col-sm-6 col-md-8 py-3 px-3 px-sm-4 px-md-4 d-flex flex-column justify-content-center">
                            <h3><strong>{{ $apartment->name }} </strong></h3>
                            <div>
                                <h6><strong>{{ $apartment->apartment_type->name }}</strong></h6>
                                <p><strong>Prezzo per notte:</strong> {{ $apartment->price_per_night }}€</p>
                                <p class="fw-bold {{ $apartment->visible ? 'text-success' : 'text-danger' }}">
                                    @if ($apartment->visible)
                                        Disponibile &#x2713;
                                    @else
                                        Non Disponibile &#x2717;
                                    @endif
                                </p>
                            </div>
                            <div class="index_buttons">
                                <div
                                    class="d-flex justify-content-start justify-content-sm-center justify-content-md-start flex-wrap flex-sm-column flex-md-row gap-2">
                                    <a class="btn my-2 btn-light strong_shadow"
                                        href="{{ route('admin.apartments.show', $apartment) }}">
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye-fill vertical_align_text_top"
                                                viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                        </span>
                                        <span class="text_from_left">Dettagli</span>
                                    </a>
                                    <a class="btn my-2  btn-light strong_shadow"
                                        href="{{ route('admin.apartments.edit', $apartment) }}">
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-fill vertical_align_text_top"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                        </span>
                                        <span class="text_from_left">Modifica</span>
                                    </a>
                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-dark my-2 strong_shadow " data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $apartment->id }}">
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
                                    <div class="modal fade text-black" id="modalId-{{ $apartment->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId-{{ $apartment->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitle-{{ $apartment->id }}">
                                                        Eliminare l'annuncio
                                                        {{ $apartment->name }}?
                                                    </h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-dark"
                                                        data-bs-dismiss="modal">Chiudi</button>
                                                    <form
                                                        action="{{ route('admin.apartments.destroy', $apartment->slug) }}"
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
                    <hr>
                @empty
                    <div class="col">
                        <h3 class="text-center">Non hai ancora registrato alcun appartamento</h3>
                    </div>
                @endforelse
            </div>
            {{ $apartments->links('pagination::bootstrap-5') }}
        </div>
    </section>
@endsection
