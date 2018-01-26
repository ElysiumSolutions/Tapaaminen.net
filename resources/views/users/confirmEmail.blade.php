@extends('layouts.app')

@section('content')

    <div class="columns">
        <div class="column is-half is-offset-one-quarter">
            <div class="box">

                <h3 class="title is-3">Vahvista sähköpostisi</h3>

                <p>Lähetimme sinulle juuri sähköpostia (tarkista myös roskapostikansio). Sähköpostissa on koodi, joka sinun tulee kopioida alla olevalle lomakkeella. Tämän jälkeen olet vahvistanut sähköpostisi.</p>

                <p><br /></p>

                <form role="form" method="POST" action="{{ url('/vahvista/sahkoposti') }}">
                    {{ csrf_field() }}

                    <div class="field">
                        <p class="control{{ $errors->has('code') ? ' has-icon has-icon-right' : '' }}">
                            <input id="code" type="text" class="input{{ $errors->has('code') ? ' is-danger' : '' }}" name="code" placeholder="Vahvistuskoodi" value="{{ old('code') }}" required autofocus>
                            @if ($errors->has('code'))
                                <span class="icon is-small">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                                <span class="help is-danger">{{ $errors->first('code') }}</span>
                            @endif
                        </p>
                    </div>

                    <button type="submit" class="button is-info">Vahvista sähköposti</button>
                </form>
            </div>
        </div>
    </div>

@endsection