@extends('layouts.app')

@section('content')

@section('content')

@if(session("message"))
<div class="alert alert-success" role="alert">
  <strong>{{ session("message") }}</strong>
</div>
@endif

<section>
    <h2>Elenco degli appartamenti</h2>
    <div class="container">
        <div class="row">
            @forelse($apartments as $apartment)
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ $apartment->name }}</div>
                    <div class="card-image">
                        <img src="{{ asset('storage/' . $apartment->image) }}" alt="Immagine {{ $apartment->name }}">
                    </div>
                    <div class="card-body">
                        <h5><strong>Descrizione </strong></h5>
                        <p>{{ $apartment->description }}</p>
                        <p><strong>Prezzo per notte:</strong> {{ $apartment->price_per_night }}€</p>
                        <p>Quest'appartamento è ancora disponibile?: {{ $apartment->visible ? "Si" : "No" }}</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary" href="{{ route('admin.apartments.show', $apartment) }}">Dettagli</a>
                        <a class="btn btn-primary" href="{{ route('admin.apartments.edit', $apartment) }}">Modifica</a>
                        <form class="mt-3" action="{{ route('admin.apartments.destroy', $apartment) }}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-primary">Elimina</button>
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
    </div>
    <a class="btn btn-primary" href="{{ route('admin.apartments.create') }}">Aggiungi appartamento</a>
</section>
@endsection
