@extends('layouts.app')

@section('content')

    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <article class="tile is-child notification is-info">
                <div class="content">
                    <p class="title">Tapaaminen.net</p>
                    <div class="content">
                        <p>Sivuston tarkoituksena on tarjota käyttäjälle mahdollisuus sopia tapaamisia ilmaiseksi ja helposti.</p>

                        <p>Tapaamisen luonti ei vaadi rekisteröitymistä, mutta ilmainen käyttäjätili tuo lisää ominaisuuksia ja mahdollisuuden kysyä apua tai auttaa muita palstalla.</p>

                        <p>Tarjoamme apua sähköpostin <a href="mailto:apua@tapaaminen.net">apua@tapaaminen.net</a> kautta.</p>
                    </div>
                </div>
            </article>
        </div>
        <div class="tile is-vertical is-8">
            <div class="tile">
                <div class="tile is-parent is-vertical">
                    <article class="tile is-child notification is-warning">
                        <p class="title">Uudistus</p>
                        <div class="content">
                            <p>Tapaaminen.net uudistui kesällä 2017. Uudistuksen myötä tuli iso kasa uusia ominaisuuksia ja parannuksia. Vanha versio jatkaa elämää osoitteen <a href="https://vanha.tapaaminen.net" target="_blank">vanha.tapaaminen.net</a> kautta.</p>

                            <p>Koko järjestelmä on tehty uudelleen Laravelin pohjalle. Isoimpana uudistuksena on käyttäjätilit.</p>

                            <p>Uudistuksen myötä Tapaaminen.net on avointa lähdekoodia. Sitä kehitetään taas aktiivisesti. Lisää infoa löytyy <a href="https://github.com/ElysiumSolutions/Tapaaminen.net" target="_blank">Githubista</a>.</p>
                        </div>
                    </article>
                </div>
                <div class="tile is-parent is-vertical">
                    <article class="tile is-child notification">
                        <p class="title">Tulossa</p>
                        <div class="content">
                            <p>Suurin osa vanhan toiminnallisuuksista on tuotu jo tänne. Osa on kuitenkin vielä työn alla!</p>
                            <ul>
                                <li>Tapaamisen lukitseminen</li>
                                <li>Tapaamisen poistaminen</li>
                                <li>Tapaamisen lopettaminen</li>
                                <li>Tapaamisen osallistumisien muokkaus</li>
                                <li>Tapaamisen aikojen lisäys</li>
                                <li>Tapaamisen aikojen Poisto</li>
                            </ul>
                        </div>
                    </article>
                </div>

            </div>
        </div>

    </div>

    <div class="tile is-ancestor">
        <div class="tile is-vertical is-9">
            <div class="tile">
                <div class="tile is-parent is-vertical">
                    <article class="tile is-child notification">
                        <p class="title">Tukijat ja käytetyt palvelut</p>
                        <div class="content">
                            <p><strong>Elysium Solutions Oy</strong> tarjoaa sivutilan ja domainin. <a href="https://elysium.fi" class="button is-small is-black is-outlined" target="_blank">elysium.fi</a></p>
                            <p><strong>Groove</strong> on käytössä sähköpostituessa. <a href="https://www.groovehq.com/" class="button is-small is-black is-outlined" target="_blank">groovehq.com</a></p>
                            <p><strong>Bugsnag</strong> ilmoittaa automaattisesti virheistä. <a href="https://www.bugsnag.com/" class="button is-small is-black is-outlined" target="_blank">bugsnag.com</a></p>
                            <p><strong>Github</strong> on käytössä versionhallinnassa. <a href="https://github.com/" class="button is-small is-black is-outlined" target="_blank">github.com</a></p>
                            <p><strong>Marko Kaartinen</strong> on koodannut tämän. <a href="https://markokaartinen.net" class="button is-small is-black is-outlined" target="_blank">markokaartinen.net</a></p>
                            <p><strong>Laravel</strong> on käytössä frameworkkinä. <a href="https://laravel.com/" class="button is-small is-black is-outlined" target="_blank">laravel.com</a></p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <div class="tile is-parent">
            <article class="tile is-child notification is-info">
                <p class="title">Linkkejä</p>
                <div class="content">
                    <p><a class="button is-light is-outlined" href="{{ url('evasteet') }}">Evästeet</a></p>
                    <p><a class="button is-light is-outlined" href="{{ url('rekisteriseloste') }}">Rekisteriseloste</a></p>
                    <p><a class="button is-light is-outlined" href="https://markokaartinen.net" target="_blank">Marko Kaartinen</a></p>
                    <p><a class="button is-light is-outlined" href="https://elysium.fi" target="_blank">Elysium Solutions Oy</a></p>
                    <p><a class="button is-light is-outlined" href="https://github.com/ElysiumSolutions/Tapaaminen.net" target="_blank">Github</a></p>
                </div>
            </article>
        </div>
    </div>


@endsection
