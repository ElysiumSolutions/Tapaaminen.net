@extends('layouts.app')

@section('content')

<h3 class="title is-3">Luo tili</h3>

    <form role="form" method="POST" action="{{ url('/luo-tili') }}">
        {{ csrf_field() }}

        <label class="label">Nimi</label>
        <p class="control{{ $errors->has('name') ? ' has-icon has-icon-right' : '' }}">
            <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" placeholder="Nimi" value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
                <span class="icon is-small">
                    <i class="fa fa-warning"></i>
                </span>
                <span class="help is-danger">{{ $errors->first('name') }}</span>
            @endif
        </p>
        
        <label class="label">Sähköposti</label>
        <p class="control{{ $errors->has('email') ? ' has-icon has-icon-right' : '' }}">
            <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" placeholder="Sähköposti" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="icon is-small">
                    <i class="fa fa-warning"></i>
                </span>
                <span class="help is-danger">{{ $errors->first('email') }}</span>
            @endif
        </p>

        <label class="label">Salasana</label>
        <p class="control{{ $errors->has('password') ? ' has-icon has-icon-right' : '' }}">
            <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required>
            @if ($errors->has('password'))
                <span class="icon is-small">
                    <i class="fa fa-warning"></i>
                </span>
                <span class="help is-danger">{{ $errors->first('password') }}</span>
            @endif
        </p>

        <label class="label">Vahvista salasana</label>
        <p class="control">
            <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
        </p>

        <div class="control is-grouped">
            <p class="control">
                <button class="button is-info">Luo tili</button>
            </p>
            <p class="control">
                <a class="button is-link" href="{{ url('/') }}">Peruuta</a>
            </p>
        </div>
    </form>
@endsection
