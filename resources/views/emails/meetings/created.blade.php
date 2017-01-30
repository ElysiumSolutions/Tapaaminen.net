@component('mail::message')
# Uusi tapaaminen luotu

Loit juuri uuden tapaamisen nimeltä {{ $meeting->name }}. Alla on hieman tietoja tapaamisestasi.

Tapaamisen linkkiä voit jakaa osallistujille vapaasti. Hallinnan linkki on tarkoitettu tapaamisen hallintaan ja sitä ei suositella jaettavaksi.

@component('mail::button', ['url' => url("/s/".$meeting->slug) ])
    Näytä tapaaminen
@endcomponent

**Tapaamisen linkki:**
@component('mail::panel')
{{ url('/s/'.$meeting->slug) }}
@endcomponent

**Hallinnan linkki:**
@component('mail::panel')
{{ url('/a/'.$meeting->adminslug) }}
@endcomponent

Terveisin,<br>
{{ config('app.name') }}
@endcomponent
