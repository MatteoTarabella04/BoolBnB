@extends('layouts.app')

@section('content')

<section>
    <div class="container">
        @if(session("message"))
        <div class="alert alert-success" role="alert">
            <strong>{{ session("message") }}</strong>
        </div>
        @endif
        <h2>Elenco degli appartamenti</h2>
        <div class="row">
            @forelse($apartments as $apartment)
            <div class="col-12 d-lg-flex d-sm-block rounded-1 m-1">
                <div class="col-lg-4 col-sm-12 p-1">
                    <img src="{{ asset('storage/' . $apartment->image) }}" alt="Immagine {{ $apartment->name }}">
                </div>
                <div class="col-lg-8 col-sm-12 p-1">
                    <h5><strong>Appartamento </strong></h5>
                    <div class="">{{ $apartment->name }}</div>
                    
                    <div class="">
                        <h5><strong>Descrizione </strong></h5>
                        <p>{{ $apartment->description }}</p>
                        <p><strong>Prezzo per notte:</strong> {{ $apartment->price_per_night }}€</p>
                        <p>Quest'appartamento è ancora disponibile?: <strong>{{ $apartment->visible ? "Si" : "No" }}</strong> </p>
                    </div>
                    <div class="index_buttons">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.apartments.show', $apartment) }}">Dettagli</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.apartments.edit', $apartment) }}">Modifica</a>
                        <form class="mt-3 d-inline-block" action="{{ route('admin.apartments.destroy', $apartment) }}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col">
                <h3 class="text-center">Non hai ancora registrato alcun appartamento</h3>
            </div>
            @endforelse
        </div>
        <a class="btn btn-primary" href="{{ route('admin.apartments.create') }}">Aggiungi appartamento</a>
    </div>
</section>
@endsection
