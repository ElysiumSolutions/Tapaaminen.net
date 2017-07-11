@extends('layouts.app')

@section('content')
    <div class="columns">
        <div class="column is-half is-offset-one-quarter">
            <div class="box">
                <h3 class="title is-3">Kirjaudu sisään</h3>

                <form role="form" method="POST" action="{{ url('/kirjaudu') }}">
                    {{ csrf_field() }}

                    <div class="field">
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
                    </div>

                    <div class="field">
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
                    </div>

                    <div class="field">
                        <p class="control">
                            <label class="checkbox">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}>
                                Muista minut
                            </label>
                        </p>
                    </div>

                    <div class="field is-grouped">
                        <p class="control">
                            <button type="submit" class="button is-info">
                                Kirjaudu
                            </button>
                        </p>
                        <p class="control">
                            <a class="button is-link" href="{{ url('/salasana/nollaa') }}">
                                Unohtuiko salasana?
                            </a>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
