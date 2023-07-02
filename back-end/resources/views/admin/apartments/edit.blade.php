@extends('layouts.app')

@section('content')
@if(session("message"))
<div class="alert alert-danger" role="alert">
  <strong>{{ session("message") }}</strong>
</div>
@endif

@if($errors->any())
@foreach($errors->all() as $error)
<div class="alert alert-danger" role="alert">
  <strong>{{$error}}</strong>
</div>
@endforeach
@endif

<div>
  <h2>Modifica annuncio</h2>
  <form action="{{ route('admin.apartments.update', $apartment) }}" method="post" enctype="multipart/form-data">
  @csrf
  @method("put")
    <div>
      <label for="image">Aggiungi o modifica un immagine:</label>
      <input type="file" id="image" name="image" accept="image/*">
      @error('image')
      <small class="text-danger">Per favore, inserisci correttamente l'immagine.</small>
      @enderror
    </div>
    <div>
      <label for="name">Nome:</label>
      <input type="text" id="name" name="name" value="{{ old('name', $apartment->name) }}" required>
      @error('name')
      <small class="text-danger">Per favore, inserisci correttamente il nome.</small>
      @enderror
    </div>
    <div>
      <label for="description">Descrizione:</label>
      <textarea id="description" name="description" required>{{ old('description', $apartment->description) }}</textarea>
      @error('description')
      <small class="text-danger">Per favore, inserisci correttamente la descrizione.</small>
      @enderror
    </div>
    <div>
      <label for="price_per_night">Prezzo a notte (€):</label>
      <input type="number" id="price_per_night" value="{{ old('price_per_night', $apartment->price_per_night) }}" name="price_per_night" required>
      @error('price_per_night')
      <small class="text-danger">Per favore, inserisci correttamente il prezzo per notte.</small>
      @enderror
    </div>
    <div>
      <label for="rooms">Numero di stanze:</label>
      <input type="number" id="rooms" name="rooms" value="{{ old('rooms', $apartment->rooms) }}" required>
      @error('rooms')
      <small class="text-danger">Per favore, inserisci correttamente il numero delle stanze.</small>
      @enderror
    </div>
    <div>
      <label for="beds">Numero di letti:</label>
      <input type="number" id="beds" name="beds" value="{{ old('beds', $apartment->beds) }}" required>
      @error('beds')
      <small class="text-danger">Per favore, inserisci correttamente il numero di posti letto.</small>
      @enderror
    </div>
    <div>
      <label for="bathrooms">Bagni:</label>
      <input type="number" id="bathrooms" name="bathrooms" value="{{ old('bathrooms', $apartment->bathrooms) }}" required>
      @error('bathrooms')
      <small class="text-danger">Per favore, inserisci correttamente il numero di bagni.</small>
      @enderror
    </div>
    <div>
      <label for="square_meters">Dimensione (mq):</label>
      <input type="number" id="square_meters" name="square_meters" value="{{ old('square_meters', $apartment->square_meters) }}" required>
      @error('square_meters')
      <small class="text-danger">Per favore, inserisci correttamente il numero di mq.</small>
      @enderror
    </div>
    <div>
      <label for="address">Indirizzo:</label>
      <input type="text" id="address" name="address" value="{{ old('address', $apartment->address) }}" required>
      @error('address')
      <small class="text-danger">Per favore, inserisci correttamente l'indirizzo.</small>
      @enderror
    </div>
    <div>
      <label for="visible">Quest'appartamento è ancora disponibile al pernottamento?:</label>
      <input type="checkbox" id="visible" name="visible" value="{{ old('visible', $apartment->visible) }}" required>
      @error('visible')
      <small class="text-danger">Per favore, indica correttamente la visibilità.</small>
      @enderror
    </div>
    <button class="btn btn-primary" type="submit">Salva modifiche</button>
  </form>
</div>
@endsection