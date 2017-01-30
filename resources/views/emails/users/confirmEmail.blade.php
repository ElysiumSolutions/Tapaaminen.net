@component('mail::message')
# Vahvista sähköpostisi

Syötä alla oleva koodi lomakkeella olevaan kenttään!

@component('mail::panel')
    {{ $token }}
@endcomponent

Terveisin,<br>
{{ config('app.name') }}
@endcomponent
