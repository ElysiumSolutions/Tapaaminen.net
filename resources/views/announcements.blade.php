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

            @if(count($announcements) > 0)
                <div class="columns is-multiline">
                    @foreach($announcements as $id => $announcement)
                        <div class="column is-one-third">
                            <div class="card">
                                <div class="card-content">
                                    <h3 class="is-title">{{ $announcement['title'] }}</h3>
                                    Tämä tiedote lähetettiin {{ $announcement['send_time'] }} yhteensä {{ $announcement['emails_sent'] }} vastaanottajalle.
                                </div>
                                <footer class="card-footer">
                                    <a class="card-footer-item" href="{{ $announcement['url'] }}" target="_blank">Avaa arkistossa</a>
                                </footer>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p><strong>Ei julkaistuja tiedotteita!</strong></p>
            @endif
        </div>
    </div>

@endsection
