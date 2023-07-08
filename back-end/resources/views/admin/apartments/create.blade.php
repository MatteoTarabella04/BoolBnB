@extends('layouts.app')

@section('javascript')
    @vite(['resources/js/insertAddress.js'])
    @vite(['resources/js/insertPreviewApartment.js'])
    @vite(['resources/js/create-apartment-validation.js'])
@endsection

@section('content')
    <div class="bg_double_show body_minus_header_block"></div>

    <div class="container">
        <div class="d-flex justify-content-end mt-4">
            <a class="btn bg_special text-end strong_shadow" href="{{ route('admin.apartments.index') }}">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path
                            d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z" />
                    </svg>
                </span>
                <span class="text_from_left" style="margin: 10px 0 5px 0;">Ritorna agli annunci</span></a>
        </div>
        <div class="row">
            <div class="col">
                <div class=" p-3 my-5 ">
                    @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ session('message') }}</strong>
                        </div>
                    @endif

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $error }}</strong>
                            </div>
                        @endforeach
                    @endif

                    <div>
                        <h4>Inserisci un annuncio!</h4>
                        <form id="create_apartment_form" action="{{ route('admin.apartments.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="d-flex justify-content-between flex-wrap align-items-center">
                                <div class="mb-3 col-12 col-md-8">
                                    <label for="image" class="form-label">Aggiungi un'immagine</label>
                                    <input type="file" class="form-control shadow" name="image" id="image"
                                        aria-describedby="helpId" accept="image/*" required>
                                    @error('image')
                                        <small class="text-danger">Per favore, inserisci correttamente l'immagine.</small>
                                    @enderror

                                </div>
                                <div id="image-preview-container"
                                    class="mt-2 d-none col-12 col-md-4 d-flex justify-content-center strong_shadow">
                                    <img id="image-preview" src="#" alt="Preview dell'immagine"
                                        style="max-width: 100%;" class="p-3">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Nome</label>
                                <input type="text" class="form-control shadow" name="name" id="name"
                                    aria-describedby="helpId" placeholder="" value="{{ old('name') }}" required>
                                @error('name')
                                    <small class="text-danger">Per favore, inserisci correttamente il nome.</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Descrizione</label>
                                <textarea class="form-control shadow" name="description" id="description" required rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">Per favore, inserisci correttamente la descrizione.</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="apartment_type_id" class="form-label">Seleziona il tipo di struttura:</label>
                                <select class="form-select shadow @error('apartment_type_ids') is-invalid @enderror"
                                    name="apartment_type_id" id="apartment_type_id" required>
                                    <option value="">-</option>
                                    @foreach ($apartment_types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $type?->id == old('apartment_type_id', []) ? 'selected' : '' }}>
                                            {{ $type?->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="price_per_night" class="form-label">Prezzo a notte (€)</label>
                                <input type="number" class="form-control shadow" name="price_per_night"
                                    id="price_per_night" aria-describedby="helpId" placeholder=""
                                    value="{{ old('price_per_night') }}" required>
                                @error('price_per_night')
                                    <small class="text-danger">Per favore, inserisci correttamente il prezzo per notte.</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="rooms" class="form-label">Numero di stanze</label>
                                <input type="number" class="form-control shadow" name="rooms" id="rooms"
                                    aria-describedby="helpId" placeholder="" value="{{ old('rooms') }}" required>
                                @error('rooms')
                                    <small class="text-danger">Per favore, inserisci correttamente il numero delle
                                        stanze.</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="beds" class="form-label">Numero di letti</label>
                                <input type="number" class="form-control shadow" name="beds" id="beds"
                                    aria-describedby="helpId" placeholder="" value="{{ old('beds') }}" required>
                                @error('beds')
                                    <small class="text-danger">Per favore, inserisci correttamente il numero di posti
                                        letto.</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bathrooms" class="form-label">Numero di bagni</label>
                                <input type="number" class="form-control shadow" name="bathrooms" id="bathrooms"
                                    aria-describedby="helpId" placeholder="" value="{{ old('bathrooms') }}" required>
                                @error('bathrooms')
                                    <small class="text-danger">Per favore, inserisci correttamente il numero di bagni.</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="square_meters" class="form-label">Metri quadri</label>
                                <input type="number" class="form-control shadow" name="square_meters"
                                    id="square_meters" aria-describedby="helpId" placeholder=""
                                    value="{{ old('square_meters') }}" required>
                                @error('square_meters')
                                    <small class="text-danger">Per favore, inserisci correttamente il numero di mq.</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Indirizzo</label>
                                <div class="position-relative" id="addressSuggestionsWrapper">
                                    <input type="text" class="form-control shadow" name="address" id="address"
                                        aria-describedby="helpId" placeholder="" value="{{ old('address') }}" required>
                                    <ul class="list-unstyled d-none list-group" id="addressSuggestions">
                                    </ul>
                                </div>
                                @error('address')
                                    <small class="text-danger">Per favore, inserisci correttamente l'indirizzo.</small>
                                @enderror
                            </div>

                            <input type="text" class="d-none" name="latitude" id="latitude"
                                aria-describedby="helpId" placeholder="" value="{{ old('latitude') }}">
                            <input type="text" class="d-none" name="longitude" id="longitude"
                                aria-describedby="helpId" placeholder="" value="{{ old('longitude') }}">

                            <div id="map" style="width: 100%; aspect-ratio: 16 / 9" class="d-none strong_shadow">
                            </div>

                            <div class="mb-3">
                                <div class='form-group'>
                                    <p class="mt-3">Seleziona i servizi:</p>
                                    @foreach ($apartment_services as $service)
                                        <div
                                            class="form-check @error('apartment_services') is-invalid @enderror apartment_services">
                                            <label class='form-check-label'>
                                                <input name='services[]' type='checkbox' value='{{ $service->id }}'
                                                    class='form-check-input shadow'
                                                    {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                                                {{ $service->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                    @error('apartment_services')
                                        <div class='invalid-feedback'>{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="visible"
                                    name="visible" {{ old('visible', []) || !$errors->any() == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="visible">
                                    Appartamento disponibile da subito
                                </label>
                                @error('visible')
                                    <small class="text-danger">Per favore, indica correttamente la visibilità.</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-dark w-100 text-uppercase strong_shadow">Aggiungi
                                appartamento</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
