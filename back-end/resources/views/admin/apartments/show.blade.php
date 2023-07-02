@extends('layouts.app')

@section('content')
<div>
  <h2>{{ $apartment->name }}</h2>
  <div class="image">
  <img src="{{ asset('storage/' . $apartment->image) }}" alt="Immagine {{ $apartment->name }}">
  </div>
  <div>
      <p><strong>Descrizione:</strong> {{ $apartment->description }}</p>
      <p><strong>Prezzo per notte:</strong> {{ $apartment->price_per_night }}€</p>
      <p>Numero di stanze: {{ $apartment->rooms }}</p>
      <p>Numero di letti: {{ $apartment->beds }}</p>
      <p>Bagni: {{ $apartment->bathrooms }}</p>
      <p>Grandezza dell'appartamento: {{ $apartment->square_meters }}mq</p>
      <p>Indirizzo:{{ $apartment->address }}</p>
      <p>Quest'appartamento è ancora disponibile?: {{ $apartment->visible ? "Si" : "No" }}</p>
  </div>
  <div>
      <a class="btn btn-primary" href="{{ route('admin.apartments.index') }}">Torna all'elenco degli appartamenti</a>
      <a class="btn btn-primary" href="{{ route('admin.apartments.edit', $apartment) }}">Modifica</a>
      <form class="mt-3" action="{{ route('admin.apartments.destroy', $apartment) }}" method="post">
        @csrf
        @method("delete")
        <button class="btn btn-primary" type="submit">Elimina</button>
      </form>
  </div>
</div>
@endsection