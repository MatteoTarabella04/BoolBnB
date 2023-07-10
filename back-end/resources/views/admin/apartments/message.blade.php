@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <h1 class="p-4"> <strong>I tuoi messaggi</strong></h1>
        
        <div class="row ">
            <div class="col-12 card message p-4 strong_shadow rounded-4">
                <h4>Messaggi Ricevuti:</h4>
                @if($messages)
                <ul class="list-group border-0">
                    @foreach($messages as $message)
                        <li class="card  list-group-item  p-4 mb-3 strong_shadow rounded-4">
                            <strong>Nome:</strong> {{ $message->full_name }} <br>
                            <strong>Email:</strong> {{ $message->sender_email }} <br>
                            <strong>Contenuto del messaggio:</strong> {{ $message->content }}
                            <br>
                            <strong>Data del messaggio:</strong> {{ $message->send_date }}
                            <br>
                            <strong>Appartamento:</strong>
                            @foreach($apartments as $apartment)
                                @if($apartment->id == $message->apartment_id)
                                {{ $apartment->name }}
                                @endif
                            @endforeach
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Non ci sono messaggi in arrivo.</p>
            @endif
            </div>
            
        </div>
    </div>
</section>
@endsection
