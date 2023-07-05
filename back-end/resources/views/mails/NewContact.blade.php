<x-mail::message>
# Nuovo contatto da {{ config('app.name') }}

<b>Contattato da:</b> {{ $lead->sender_email }}

<b>Messaggio:</b> {{ $lead->content }}

<!-- <x-mail::button :url="''">
Button Text
</x-mail::button> -->

Grazie,<br>
{{ config('app.name') }}
</x-mail::message>
