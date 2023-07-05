@extends('layouts.app')

@section('content')
    <section>
        <div class="bg_double_show body_minus_header_block"></div>
        <div class="container">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    <strong>{{ session('message') }}</strong>
                </div>
            @endif
            <h1 class="pt-3 fw-bold text-center">I tuoi annunci</h1>
            <div class="d-flex justify-content-end">
                <a class="btn bg_special text-end strong_shadow" href="{{ route('admin.apartments.create') }}">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                        </svg>
                    </span>
                    <span class="text_from_left">Inserisci annuncio</span></a>
            </div>
            <div class="row">
                @forelse($apartments as $apartment)
                    <div class="col-12 d-flex align-items-center flex-wrap rounded-1 m-1">
                        <div class="col-12 col-sm-6 col-md-4 p-3">
                            <img src="{{ asset('storage/' . $apartment->image) }}" alt="Immagine {{ $apartment->name }}"
                                class="w-100 rounded-3 strong_shadow">
                        </div>
                        <div class="col-12 col-sm-6 col-md-8 p-3 d-flex flex-column justify-content-center">
                            <h5><strong>Appartamento </strong></h5>
                            <div>{{ $apartment->name }}</div>
                            <div>
                                <h5><strong>Descrizione </strong></h5>
                                <p>{{ $apartment->description }}</p>
                                <p><strong>Prezzo per notte:</strong> {{ $apartment->price_per_night }}€</p>
                                <p>Quest'appartamento è ancora disponibile?:
                                    <strong>{{ $apartment->visible ? 'Si' : 'No' }}</strong>
                                </p>
                            </div>
                            <div class="index_buttons">
                                <div class="d-flex justify-content-start flex-wrap">
                                    <a class="btn me-2 btn-light strong_shadow"
                                        href="{{ route('admin.apartments.show', $apartment) }}">
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                        </span>
                                        <span class="text_from_left">Dettagli</span>
                                    </a>
                                    <a class="btn me-2 btn-light strong_shadow"
                                        href="{{ route('admin.apartments.edit', $apartment) }}">
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                        </span>
                                        <span class="text_from_left">Modifica</span>
                                    </a>
                                    <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-dark strong_shadow" type="submit">
                                            <span class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                </svg>
                                            </span>
                                            <span class="text_from_left">Elimina</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
