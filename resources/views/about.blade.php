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
                            <p>Uudistuksen myötä Tapaaminen.net on avointa lähdekoodia. Sitä kehitetään taas aktiivisesti. Lisää infoa löytyy <a href="https://github.com/ElysiumSolutions/Tapaaminen.net" target="_blank">Githubista</a>.</p>
                        </div>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child notification is-primary">
                        <p class="title">Linkkejä</p>
                        <div class="content">
                            <a href="{{ url('evasteet') }}">Evästeet</a><br />
                            <a href="{{ url('rekisteriseloste') }}">Rekisteriseloste</a><br />
                            <a href="https://markokaartinen.net" target="_blank">Marko Kaartinen</a><br />
                            <a href="https://elysium.fi" target="_blank">Elysium Solutions Oy</a><br />
                            <a href="https://github.com/ElysiumSolutions/Tapaaminen.net" target="_blank">Github</a><br />
                        </div>
                    </article>
                </div>
            </div>
        </div>

    </div>

    <div class="tile is-ancestor">
        <div class="tile is-vertical is-12">
            <div class="tile">
                <div class="tile is-parent is-vertical">
                    <article class="tile is-child notification">
                        <p class="title">Tukijat ja käytetyt palvelut</p>
                        <div class="content">
                            <p><strong>Elysium Solutions Oy</strong> tarjoaa sivutilan ja domainin. <a href="https://elysium.fi" class="button is-small is-dark is-outlined" target="_blank">elysium.fi</a></p>
                            <p><strong>Supportbee</strong> on käytössä sähköpostituessa (ilmainen paketti). <a href="https://supportbee.com/" class="button is-small is-dark is-outlined" target="_blank">supportbee.com</a></p>
                            <p><strong>Bugsnag</strong> ilmoittaa automaattisesti virheistä. <a href="https://www.bugsnag.com/" class="button is-small is-dark is-outlined" target="_blank">bugsnag.com</a></p>
                            <p><strong>Github</strong> on käytössä versionhallinnassa. <a href="https://github.com/" class="button is-small is-dark is-outlined" target="_blank">github.com</a></p>
                            <p><strong>Tawk.to</strong> on käytössä livechatissä. <a href="https://www.tawk.to/" class="button is-small is-dark is-outlined" target="_blank">tawk.to</a></p>
                            <p><strong>Marko Kaartinen</strong> on koodannut tämän. <a href="https://markokaartinen.net" class="button is-small is-dark is-outlined" target="_blank">markokaartinen.net</a></p>
                            <p><strong>Laravel</strong> on käytössä frameworkkinä. <a href="https://laravel.com/" class="button is-small is-dark is-outlined" target="_blank">laravel.com</a></p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>


@endsection
