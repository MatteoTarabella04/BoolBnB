@extends('layouts.app')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <h4>Messaggi Ricevuti</h4>
        </div>
        <div class="row">
            {{-- {{dd($messages)}} --}}
            @if($messages)
                <ul>
                    @foreach($messages as $message)
                        @foreach($message as $single_message)
                        <li>
                            <strong>Nome:</strong> {{ $single_message->full_name }} <br>
                            <strong>Email:</strong> {{ $single_message->sender_email }} <br>
                            <strong>Contenuto del messaggio:</strong> {{ $single_message->content }}
                        </li>
                        @endforeach
                    @endforeach
                </ul>
            @else
                <p>Non ci sono messaggi in arrivo.</p>
            @endif
        </div>
    </div>
</section>