@extends('layouts.app')

@section('content')
    <div class="columns">
        <div class="column is-half is-offset-one-quarter">
            <div class="box">
                <h3 class="title is-3">Salasanan nollaus</h3>

                @if (session('status'))
                    <div class="notification is-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form role="form" method="POST" action="{{ url('/salasana/nollaa') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="field">
                        <label class="label">Sähköposti</label>
                        <p class="control{{ $errors->has('email') ? ' has-icon has-icon-right' : '' }}">
                            <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" placeholder="Sähköposti" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="icon is-small">
                                    <i class="fas fa-exclamation-triangle"></i>
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
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                                <span class="help is-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </p>
                    </div>

                    <div class="field">
                        <label class="label">Vahvista salasana</label>
                        <p class="control{{ $errors->has('password_confirmation') ? ' has-icon has-icon-right' : '' }}">
                            <input id="password_confirmation" type="password" class="input{{ $errors->has('password_confirmation') ? ' is-danger' : '' }}" name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <span class="icon is-small">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                                <span class="help is-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </p>
                    </div>

                    <div class="field is-grouped">
                        <p class="control">
                            <button type="submit" class="button is-info">Nollaa salasana</button>
                        </p>
                        <p class="control">
                            <a class="button is-link" href="{{ url('/') }}">Peruuta</a>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
