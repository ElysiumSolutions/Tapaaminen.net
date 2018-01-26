@extends('layouts.app')

@section('content')

    <h2 class="title is-3">Muokkaa omia tietoja</h2>

    <div class="columns">
        <div class="column is-half">
            <div class="box">
                <h3 class="title is-4">
                    Perustiedot
                    <form role="form" method="POST" action="{{ url('/oma-tili/muokkaa') }}" class="pull-right">
                        {{ csrf_field() }}
                        @if(Auth::user()->subscribed)
                            <button type="submit" name="type" value="unsubscribe" class="button is-warning is-small">Peru sähköpostitiedotteet</button>
                        @else
                            <button type="submit" name="type" value="subscribe" class="button is-success is-small">Tilaa sähköpostitiedotteet</button>
                        @endif
                    </form>
                </h3>

                <form role="form" method="POST" action="{{ url('/oma-tili/muokkaa') }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="field">
                        <label class="label">Nimi</label>
                        <p class="control{{ $errors->has('name') ? ' has-icon has-icon-right' : '' }}">
                            <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" placeholder="Nimi" value="{{ old('name', $user->name) }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="icon is-small">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                                <span class="help is-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </p>
                    </div>
                    
                    <div class="field">
                        <label class="label">Käyttäjätunnus</label>
                        <p class="control{{ $errors->has('username') ? ' has-icon has-icon-right' : '' }}">
                            <input id="username" type="text" class="input{{ $errors->has('username') ? ' is-danger' : '' }}" name="username" placeholder="Käyttäjätunnus" value="{{ old('username', $user->username) }}" required >
                            @if ($errors->has('username'))
                                <span class="icon is-small">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                                <span class="help is-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </p>
                    </div>

                    <div class="field">
                        <label class="label">Sähköposti</label>
                        <p class="control{{ $errors->has('email') ? ' has-icon has-icon-right' : '' }}">
                            <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" placeholder="Sähköposti" value="{{ old('email', $user->email) }}" required>
                            @if ($errors->has('email'))
                                <span class="icon is-small">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                                <span class="help is-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </p>
                    </div>

                    <p class="control">
                        <button type="submit" class="button is-info">Muokkaa tietoja</button>
                    </p>
                </form>
            </div>
        </div>
        <div class="column is-half">
            <div class="box">
                <h3 class="title is-4">Vaihda salasana</h3>

                <form role="form" method="POST" action="{{ url('/oma-tili/muokkaa') }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="field">
                        <label class="label">Nykyinen salasana</label>
                        <p class="control{{ $errors->has('currentpassword') ? ' has-icon has-icon-right' : '' }}">
                            <input id="currentpassword" type="password" class="input{{ $errors->has('currentpassword') ? ' is-danger' : '' }}" name="currentpassword" required>
                            @if ($errors->has('currentpassword'))
                                <span class="icon is-small">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                                <span class="help is-danger">{{ $errors->first('currentpassword') }}</span>
                            @endif
                        </p>
                    </div>

                    <div class="field">
                        <label class="label">Uusi salasana</label>
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
                        <label class="label">Vahvista uusi salasana</label>
                        <p class="control">
                            <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
                        </p>
                    </div>

                    <p class="control">
                        <button type="submit" class="button is-info">Vaihda salasana</button>
                    </p>

                </form>
            </div>
        </div>
    </div>

@endsection