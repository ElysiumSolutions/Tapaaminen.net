<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix("/css/app.css") }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">

        <section class="hero is-dark is-bold">
            <div class="hero-head">
                <header class="nav">
                    <div class="container">
                        <div class="nav-left">
                            <a class="nav-item" href="{{ url('/') }}"><span class="icon"><i class="fa fa-home"></i></span></a>
                            <a class="nav-item" href="https://twitter.com/MarkoK"><span class="icon"><i class="fa fa-twitter"></i></span></a>
                            <a class="nav-item" href="https://github.com/ElysiumSolutions/Tapaaminen.net"><span class="icon"><i class="fa fa-github"></i></span></a>
                        </div>

                        <span class="nav-toggle" id="nav-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>

                        <div class="nav-right nav-menu">
                            <a href="{{ url('/palsta') }}" class="nav-item">Palsta</a>
                            @if (Auth::guest())
                                <a href="{{ url('/luo-tili') }}" class="nav-item">Luo tili</a>
                                <a href="{{ url('/kirjaudu') }}" class="nav-item">Kirjaudu sisään</a>
                            @else
                                <a href="{{ url('/oma-tili') }}" class="nav-item">Oma tili</a>
                                <a class="nav-item" href="{{ url('/ulos') }}"
                                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                    Kirjaudu ulos
                                </a>

                                <form id="logout-form" action="{{ url('/ulos') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </div>
                    </div>
                </header>
            </div>
            <div class="hero-body">
                <div class="container">
                    <h1 class="title is-2 is-hidden-mobile">
                        <a href="{{ url('/') }}">Tapaaminen.net</a>
                    </h1>
                    <h1 class="title is-3 is-hidden-tablet-only is-hidden-desktop-only is-hidden-widescreen">
                        <a href="{{ url('/') }}">Tapaaminen.net</a>
                    </h1>
                    <h2 class="subtitle">
                        Sovi tapaamisia helposti ja ilmaiseksi.
                    </h2>
                </div>
            </div>
        </section>


        <section class="section">
            <div class="container">
                @if(Auth::check() && Auth::User()->emailVerificationDate == null && Route::currentRouteName() != 'confirmEmail')
                    <!--<div class="notification is-warning">
                        <strong>Moi!</strong> Haluaisimme, että vahvistaisit sähköpostiosoitteesi. Näin ollen tiedämme, että sähköpostiosoitteesi on oikea ja voimme lähettää sinne esim. ohjeen unohtuneen salasanan nollaukseen ja muistutuksia. Tämä ilmoitus häviää automaattisesti kun sähköpostisosoitteesi on vahvistettu.<br /><br />
                        <a class="button is-danger" href="{{ url('vahvista/sahkoposti') }}">Vahvista sähköpostiosoite</a>
                    </div>-->
                @endif

                @yield('content')

            </div>
        </section>
    </div>

    <!-- Scripts -->
    <script src="{{ mix("/js/app.js") }}"></script>
</body>
</html>
