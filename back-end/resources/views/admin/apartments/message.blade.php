@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <h4>Messaggi Ricevuti</h4>
        <div class="row">
            @if($messages)
                <ul>
                    @foreach($messages as $message)
                        <li>
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
</section>
@endsection
