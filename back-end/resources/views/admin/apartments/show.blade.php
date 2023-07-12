@extends('layouts.app')

@section('javascript')
    @vite(['resources/js/insertAddress.js'])
@endsection

@section('content')
    <div>
        <div class="bg_double_show body_minus_header_block"></div>

        <div class="container py-5 px-2 rounded-4">
        {{-- messaggio effettuata sponsorizzazione --}}
        @if (session('success_message'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong> {{ session('success_message') }}</strong>
            </div>
        @endif
            <a class="btn btn-dark strong_shadow" href="{{ route('admin.apartments.index') }}">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path
                            d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z" />
                    </svg>
                </span>
                <span class="text_from_left">Ritorna agli annunci</span>
            </a>

            <div class="info_container mt-4 d-flex justify-content-center flex-wrap">
                <div
                    class="mt-2 mt-md-0 col-12 col-md-6 col-lg-8 d-flex flex-column align-items-start justify-content-center">
                    <h1 class="fw-bold">{{ $apartment->name }}</h1>
                    <h3 class="fw-bold">{{ $apartment->apartment_type->name }}</h3>
                    <p><strong>Descrizione:</strong> {{ $apartment->description }}</p>
                    <p><strong>Prezzo per notte:</strong> {{ $apartment->price_per_night }}€</p>
                    <p><strong>Numero di stanze:</strong> {{ $apartment->rooms }}</p>
                    <p><strong>Numero di letti:</strong> {{ $apartment->beds }}</p>
                    <p><strong>Bagni:</strong> {{ $apartment->bathrooms }}</p>
                    <p><strong>Grandezza dell'appartamento:</strong> {{ $apartment->square_meters }}mq</p>
                    <p><strong>Indirizzo:</strong>{{ $apartment->address }}</p>
                    <p class="fw-bold {{ $apartment->visible ? 'text-success' : 'text-danger' }}">
                        @if ($apartment->visible)
                            Disponibile &#x2713;
                        @else
                            Non Disponibile &#x2717;
                        @endif
                    </p>

                    @if ($apartment->services->isNotEmpty())
                        <h5 class="fw-bold">Services</h5>
                        <p>
                            <?php
                            for ($i = 0; $i < count($apartment->services); $i++) {
                                echo '<span class="me-2 fw-bold">' . $apartment->services[$i]->name . ' ' . '</span>';
                            }
                            ?>
                        </p>
                    @endif
                    <div class="d-flex justify-content-start flex-wrap gap-2">
                        <a class="btn btn-dark shadow" href="{{ route('admin.apartments.edit', $apartment) }}"> <span
                                class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                </svg>
                            </span>
                            <span class="text_from_left">Modifica</span></a>
                        <a class="btn btn-warning shadow" href="{{ route('admin.sponsor_plans', $apartment) }}"> <span
                                class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-coin" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z" />
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                                </svg>
                            </span>
                            <span class="text_from_left">Sponsorizza</span></a>

                        <form class="" action="{{ route('admin.apartments.destroy', $apartment) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger shadow" type="submit">
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
                <div
                    class="image mt-4 mt-md-0 col-12 col-md-6 col-lg-4 ps-md-4 d-flex justify-content-center align-items-center flex-column ">
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $apartment->image) }}" class="rounded-4 strong_shadow image_aspect_ratio"
                            style="width: 100%; max-width:500px;" alt="Immagine {{ $apartment->name }}">
                            @if($hasSponsorization)
                            <div class="sponsorization_badge">
                                <svg fill="#ffc107" xmlns="http://www.w3.org/2000/svg" width="10%" viewBox="0 0 576 512">
                                    <path d="M309 106c11.4-7 19-19.7 19-34c0-22.1-17.9-40-40-40s-40 17.9-40 40c0 14.4 7.6 27 19 34L209.7 220.6c-9.1 18.2-32.7 23.4-48.6 10.7L72 160c5-6.7 8-15 8-24c0-22.1-17.9-40-40-40S0 113.9 0 136s17.9 40 40 40c.2 0 .5 0 .7 0L86.4 427.4c5.5 30.4 32 52.6 63 52.6H426.6c30.9 0 57.4-22.1 63-52.6L535.3 176c.2 0 .5 0 .7 0c22.1 0 40-17.9 40-40s-17.9-40-40-40s-40 17.9-40 40c0 9 3 17.3 8 24l-89.1 71.3c-15.9 12.7-39.5 7.5-48.6-10.7L309 106z"/>
                                </svg>
                            </div>
                            @endif
                    </div>
                    <input type="text" class="form-control d-none" name="latitude" id="latitude"
                        aria-describedby="helpId" placeholder="" value="{{ old('latitude', $apartment->latitude) }}"
                        required>
                    <input type="text" class="form-control d-none" name="longitude" id="longitude"
                        aria-describedby="helpId" placeholder="" value="{{ old('longitude', $apartment->longitude) }}"
                        required>

                    <div id="map" style="width: 100%;max-width:500px; aspect-ratio: 12 / 9"
                        class="rounded-4 strong_shadow mt-3">
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
