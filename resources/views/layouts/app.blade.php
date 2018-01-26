<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }} - Sovi tapaamisia helposti ja ilmaiseksi</title>
    <meta name="description" content="Tapaaminen.net sivustolla voit sopia tapaamisia helposti ja ilmaiseksi. Sovi vaikka lounaasta tai yhteisestä kokoontumisesta.">
    @if(isset($robots) && $robots)
        <meta name="robots" content="index, follow">
    @else
        <meta name="robots" content="noindex, nofollow">
    @endif
    <meta name="author" content="Tapaaminen.net / Marko Kaartinen">

    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:locale" content="fi_FI">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }} - Sovi tapaamisia helposti ja ilmaiseksi">
    <meta property="og:description" content="Tapaaminen.net sivustolla voit sopia tapaamisia helposti ja ilmaiseksi. Sovi vaikka lounaasta tai yhteisestä kokoontumisesta.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ url('some.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@MarkoK">
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }} - Sovi tapaamisia helposti ja ilmaiseksi">
    <meta name="twitter:description" content="Tapaaminen.net sivustolla voit sopia tapaamisia helposti ja ilmaiseksi. Sovi vaikka lounaasta tai yhteisestä kokoontumisesta.">
    <meta name="twitter:image" content="{{ url('some.jpg') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#8fc400">
    <meta name="apple-mobile-web-app-title" content="Tapaaminen.net">
    <meta name="application-name" content="Tapaaminen.net">
    <meta name="theme-color" content="#363636">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(env('APP_ENV') != "local")
        <!-- Google analytics -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-40778764-1', 'auto');
            ga('send', 'pageview');

        </script>

        <!-- mailchimp -->
        <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/d8e735d6779431a48711add6e/9450c154e84779b9740e5b68d.js");</script>

    @endif

    <!-- Styles -->
    <link href="{{ mix("/css/app.css") }}" rel="stylesheet">

    <script src='https://www.google.com/recaptcha/api.js?hl=fi'></script>

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
                            <a class="nav-item" href="https://twitter.com/MarkoK" target="_blank"><span class="icon"><i class="fa fa-twitter"></i></span></a>
                            <a class="nav-item" href="https://github.com/ElysiumSolutions/Tapaaminen.net" target="_blank"><span class="icon"><i class="fa fa-github"></i></span></a>
                        </div>

                        <span class="nav-toggle" id="nav-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>

                        <div class="nav-right nav-menu">
                            {{--<a href="{{ url('/palsta') }}" class="nav-item">Palsta</a>--}}
                            <a href="{{ url('/tiedotteet') }}" class="nav-item">Tiedotteet</a>
                            <a href="{{ url('/tietoa') }}" class="nav-item">Tietoa</a>
                            <a href="{{ url('/slack') }}" class="nav-item">Slack</a>
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
                @include('layouts.flashmessage')

                @if(Auth::check() && Auth::User()->emailVerificationDate == null && Route::currentRouteName() != 'confirmEmail')
                    <div class="message is-warning">
                        <div class="message-body">
                            <strong>Moi!</strong> Haluaisimme, että vahvistaisit sähköpostiosoitteesi. Näin ollen tiedämme, että sähköpostiosoitteesi on oikea ja voimme lähettää sinne esim. ohjeen unohtuneen salasanan nollaukseen ja muistutuksia. Tämä ilmoitus häviää automaattisesti kun sähköpostisosoitteesi on vahvistettu.<br /><br />
                            <a class="button is-warning" href="{{ url('vahvista/sahkoposti') }}">Vahvista sähköpostiosoite</a>
                        </div>
                    </div>
                @endif

                @yield('content')

            </div>
        </section>

        @include('cookieConsent::index')
    </div>

    <!-- Groove -->
    <script id="grv-widget">
        /*<![CDATA[*/
        window.groove = window.groove || {}; groove.widget = function(){ groove._widgetQueue.push(Array.prototype.slice.call(arguments)); }; groove._widgetQueue = [];
        groove.widget('setWidgetId', 'b7dd3478-5093-6a70-9140-42503e12d94a');
        !function(g,r,v){var a,n,c=r.createElement("iframe");(c.frameElement||c).style.cssText="width: 0; height: 0; border: 0",c.title="",c.role="presentation",c.src="javascript:false",r.body.appendChild(c);try{a=c.contentWindow.document}catch(i){n=r.domain;var b=["javascript:document.write('<he","ad><scri","pt>document.domain=","\"",n,"\";</scri","pt></he","ad><bo","dy></bo","dy>')"];c.src=b.join(""),a=c.contentWindow.document}var d="https:"==r.location.protocol?"https://":"http://",s="http://groove-widget-production.s3.amazonaws.com".replace("http://",d);c.className="grv-widget-tag",a.open()._l=function(){n&&(this.domain=n);var t=this.createElement("script");t.type="text/javascript",t.charset="utf-8",t.async=!0,t.src=s+"/loader.js",this.body.appendChild(t)};var p=["<bo",'dy onload="document._l();">'];a.write(p.join("")),a.close()}(window,document)
        /*]]>*/
    </script>

    <!-- Scripts -->
    <script src="{{ mix("/js/app.js") }}"></script>
</body>
</html>
