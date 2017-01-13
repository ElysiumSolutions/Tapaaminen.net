<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

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
                        @if (Auth::guest())
                            <a href="#" class="nav-item">Luo tili</a>
                            <a href="#" class="nav-item">Kirjaudu sisään</a>
                        @else
                            <a href="#" class="nav-item">Oma tili</a>
                            <a href="#" class="nav-item">Kirjaudu ulos</a>
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
            <div class="columns">
                <div class="column is-two-thirds">
                    @yield('content')
                </div>
                <div class="column is-one-third">
                    @include('layouts.sidebar')
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>