@extends('layouts.app')

@section('content')

    <div class="box">
        <div class="content">
            <h2 class="title is-3">Tiedotteet</h2>

            <p>
                Julkaisemme tiedotteita käyttäen Mailchimppiä.
                @if(Auth::check())
                    Voit tilata tiedotteet sähköpostiin <a href="{{ url('/oma-tili/muokkaa') }}">muokkaamalla omia tietoja</a>.
                @else
                    Voit tilata tiedotteet sähköpostiisi käyttämällä alla olevaa lomaketta.
                @endif
                Lähetämme sinulle vain ja ainoastaan tiedotteita liittyen Tapaaminen.net sivuston toimintaan sekä uudistuksiin. Emme lähetä sinulle roskapostia emmekä jaa tietojasi muille.
            </p>
        </div>
    </div>
    @if(Auth::guest())
        <div class="box">
            <div class="content">
                <h2 class="is-title is-4">Tilaa tiedotteet sähköpostiisi</h2>
                <form role="form" method="POST" action="{{ url('/tiedotteet') }}">
                    {{ csrf_field() }}

                    <div class="columns">
                        <div class="column">
                            <div class="field">
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
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
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
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Ihmisyystarkastus</label>
                        <p class="control">
                            <div class="g-recaptcha" data-sitekey="{{ config('google.recaptcha.sitekey') }}"></div>
                            @if ($errors->has('g-recaptcha-response'))

                                <span class="help is-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                            @endif
                            <br />
                        </p>

                    </div>

                    <div class="field">
                        <p class="control">
                            <button type="submit" class="button is-info">Tilaa tiedotteet sähköpostiin</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if(count($announcements) > 0)
        <div class="columns is-multiline">
            @foreach($announcements as $id => $announcement)
                <div class="column is-one-third">
                    <div class="card">
                        <div class="card-content">
                            <div class="content">
                                <h3 class="is-title">{{ $announcement['title'] }}</h3>
                                Tämä tiedote lähetettiin {{ $announcement['send_time'] }} yhteensä {{ $announcement['emails_sent'] }} vastaanottajalle.
                            </div>
                        </div>
                        <footer class="card-footer">
                            <a class="card-footer-item" href="{{ $announcement['url'] }}" target="_blank">Avaa arkistossa</a>
                        </footer>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="box">
            <p><strong>Ei julkaistuja tiedotteita!</strong></p>
        </div>
    @endif

@endsection
