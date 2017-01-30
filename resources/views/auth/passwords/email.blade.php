@extends('layouts.app')

@section('content')
    <h3 class="title is-3">Unohtuiko salasana?</h3>

    @if (session('status'))
        <div class="notification is-success">
            {{ session('status') }}
        </div>
    @endif

    <form role="form" method="POST" action="{{ url('/salasana/sahkoposti') }}">
        {{ csrf_field() }}

        <label class="label">Sähköposti</label>
        <p class="control{{ $errors->has('email') ? ' has-icon has-icon-right' : '' }}">
            <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" placeholder="Sähköposti" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="icon is-small">
                    <i class="fa fa-warning"></i>
                </span>
                <span class="help is-danger">{{ $errors->first('email') }}</span>
            @endif
        </p>

        <div class="control is-grouped">
            <p class="control">
                <button type="submit" class="button is-info">
                    Lähetä salasanan nollauslinkki sähköpostiin
                </button>
            </p>
            <p class="control">
                <a class="button is-link" href="{{ url('/kirjaudu') }}">
                    Peruuta
                </a>
            </p>
        </div>
    </form>
@endsection
