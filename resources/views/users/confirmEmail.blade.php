@extends('layouts.app')

@section('content')

    <h3 class="title is-3">Vahvista sähköpostisi</h3>

    <p>Lähetimme sinulle juuri sähköpostia (tarkista myös roskapostikansio). Sähköpostissa on koodi, joka sinun tulee kopioida alla olevalle lomakkeella. Tämän jälkeen olet vahvistanut sähköpostisi.</p>

    <p><br /></p>

    <form role="form" method="POST" action="{{ url('/vahvista/sahkoposti') }}">
        {{ csrf_field() }}

        <p class="control{{ $errors->has('code') ? ' has-icon has-icon-right' : '' }}">
            <input id="code" type="text" class="input{{ $errors->has('code') ? ' is-danger' : '' }}" name="code" placeholder="Vahvistuskoodi" value="{{ old('code') }}" required autofocus>
            @if ($errors->has('code'))
                <span class="icon is-small">
                    <i class="fa fa-warning"></i>
                </span>
                <span class="help is-danger">{{ $errors->first('code') }}</span>
            @endif
        </p>

        <button type="submit" class="button is-info">Vahvista sähköposti</button>
    </form>

@endsection