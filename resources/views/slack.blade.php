@extends('layouts.app')

@section('content')

    <div class="box">
        <div class="content">
            <h2 class="title is-3">Slack</h2>

            <p>Käytämme Slack nimistä ohjelmaa keskusteluun liittyen Tapaaminen.net sivustoon/projektiin. Slack on ilmainen (myös maksullisia vaihtoehtoja) sovellus. Lisää infoa Slackistä löydät heidän sivuilta <a href="https://slack.com/" target="_blank">slack.com</a>.</p>

            <h3 class="title is-5">Miten liityn?</h3>
            <p>Se on kuule helppoa. Klikkaat alla olevaa nappia ja syötät sähköpostisi siihen. Sinne tulee sitten kutsu liittyä Tapaaminen.net tiimin.</p>
            <p><script async defer src="https://tapaaminen.herokuapp.com/slackin.js?large"></script></p>

            <h3 class="title is-5">Kanavat</h3>
            <p>Meillä on pari kanavaa ja käydään hieman läpi niiden käyttötarkoituksia.</p>
            <p><strong>#yleinen</strong><br />
            Tämä on pääasiallisesti yleistä keskustelua ja palautetta varten.</p>
            <p><strong>#kehitys</strong><br />
            Kehitykseen liittyvää keskustelua.</p>
            <p><strong>#tuki</strong><br />
            Mikäli kaipaat apua liittyen Tapaaminen.nettiin ja sen käyttämiseen niin kysy täällä!</p>
        </div>
    </div>

@endsection
