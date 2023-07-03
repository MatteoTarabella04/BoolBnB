@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card p-3 my-5 ">
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
            <form action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                  <label for="image" class="form-label">Aggiungi un'immagine</label>
                  <input type="file"
                    class="form-control" name="image" id="image" aria-describedby="helpId">
                    @error('image')
                        <small class="text-danger">Per favore, inserisci correttamente l'immagine.</small>
                    @enderror
                </div>


                <div class="mb-3">
                  <label for="" class="form-label">Nome</label>
                  <input type="text"
                    class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="" value="{{ old('name') }}" required>
                  @error('name')
                      <small class="text-danger">Per favore, inserisci correttamente il nome.</small>
                  @enderror
                </div>
                
                <div class="mb-3">
                  <label for="description" class="form-label">Descrizione</label>
                  <textarea class="form-control" name="description" id="description" required rows="3">{{ old('description') }}</textarea>
                  @error('description')
                      <small class="text-danger">Per favore, inserisci correttamente la descrizione.</small>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="price_per_night" class="form-label">Prezzo a notte (€)</label>
                  <input type="number"
                    class="form-control" name="price_per_night" id="price_per_night" aria-describedby="helpId" placeholder="" value="{{ old('price_per_night') }}" required>
                    @error('price_per_night')
                        <small class="text-danger">Per favore, inserisci correttamente il prezzo per notte.</small>
                    @enderror
                </div>

                <div class="mb-3">
                  <label for="rooms" class="form-label">Numero di stanze</label>
                  <input type="number"
                    class="form-control" name="rooms" id="rooms" aria-describedby="helpId" placeholder="" value="{{ old('rooms') }}" required>
                    @error('rooms')
                        <small class="text-danger">Per favore, inserisci correttamente il numero delle stanze.</small>
                    @enderror
                </div>

                <div class="mb-3">
                  <label for="beds" class="form-label">Numero di letti</label>
                  <input type="number"
                    class="form-control" name="beds" id="beds" aria-describedby="helpId" placeholder="" value="{{ old('beds') }}" required>
                    @error('beds')
                        <small class="text-danger">Per favore, inserisci correttamente il numero di posti letto.</small>
                    @enderror
                </div>             
        
                <div class="mb-3">
                  <label for="bathrooms" class="form-label">Numero di bagni</label>
                  <input type="number"
                    class="form-control" name="bathrooms" id="bathrooms" aria-describedby="helpId" placeholder="" value="{{ old('bathrooms') }}" required>
                    @error('bathrooms')
                        <small class="text-danger">Per favore, inserisci correttamente il numero di bagni.</small>
                    @enderror
                </div>               

                <div class="mb-3">
                  <label for="square_meters" class="form-label">Metri quadri</label>
                  <input type="number"
                    class="form-control" name="square_meters" id="square_meters" aria-describedby="helpId" placeholder="" value="{{ old('square_meters') }}" required>
                    @error('square_meters')
                        <small class="text-danger">Per favore, inserisci correttamente il numero di mq.</small>
                    @enderror
                </div>


                <div class="mb-3">
                  <label for="address" class="form-label">Indirizzo</label>
                  <input type="text"
                    class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="" value="{{ old('address') }}" required>
                  @error('address')
                      <small class="text-danger">Per favore, inserisci correttamente l'indirizzo.</small>
                  @enderror
                </div>
          
                
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" value="1" id="visible" checked>
                  <label class="form-check-label" for="visible">
                    Appartamento disponibile da subito
                  </label>
                  @error('visible')
                      <small class="text-danger">Per favore, indica correttamente la visibilità.</small>
                  @enderror
                </div>


                <button type="submit" class="btn btn-primary w-100 text-uppercase">Aggiungi appartamento</button>
            </form>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection