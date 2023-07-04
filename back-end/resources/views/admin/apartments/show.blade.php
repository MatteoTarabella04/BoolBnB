@extends('layouts.app')

@section('content')

<section>
  <div class="container">
    <div class="row">
      <div class="col-12 d-flex m-auto mt-3 justify-center rounded-1">
        <div class="image col-4">
        <img src="{{ asset('storage/' . $apartment->image) }}" alt="Immagine {{ $apartment->name }}">
        </div>
        <div class="apartment_description m-1 col-8 p-2">
            <h2>{{ $apartment->name }}</h2>
            <p><strong>Descrizione:</strong> {{ $apartment->description }}</p>
            <p><strong>Prezzo per notte:</strong> {{ $apartment->price_per_night }}€</p>
            <p> <strong>Numero di stanze:</strong> {{ $apartment->rooms }}</p>
            <p><strong>Numero di letti:</strong> {{ $apartment->beds }}</p>
            <p><strong>Bagni:</strong> {{ $apartment->bathrooms }}</p>
            <p><strong>Grandezza dell'appartamento:</strong> {{ $apartment->square_meters }}mq</p>
            <p><strong>Indirizzo:</strong>{{ $apartment->address }}</p>
            <p>Quest'appartamento è ancora disponibile?:<strong>{{ $apartment->visible ? "Si" : "No" }}</strong> </p>
            <a class="btn btn-primary" href="{{ route('admin.apartments.index') }}">Torna all'elenco degli appartamenti</a>
            <a class="btn btn-primary" href="{{ route('admin.apartments.edit', $apartment) }}">Modifica</a>
            <form class="mt-3 d-inline-block" action="{{ route('admin.apartments.destroy', $apartment) }}" method="post">
              @csrf
              @method("delete")
              <button class="btn btn-danger" type="submit">Elimina</button>
            </form>
        </div>
        
      </div>
    </div>
    @endsection
  </div>
</section>
