@extends('layouts.app')

@section('content')

        <div class="columns">
            <div class="column is-half">

            </div>
            <div class="column is-half">
                <article class="message is-success">
                    <div class="message-body">
                        <strong>Tervetuloa Tapaaminen.net sivustolle!</strong><br />
                        Sivuston tarkoituksena on tarjota käyttäjälle mahdollisuus sopia tapaamisia ilmaiseksi ja helposti.<br />
                        <br />
                        Tapaamisen luonti ei vaadi rekisteröitymistä, mutta ilmainen käyttäjätili tuo lisää ominaisuuksia ja mahdollisuuden kysyä apua tai auttaa muita palstalla.<br />
                        <br />
                        Katsot juuri Tapaaminen.net sivuston uutta versiota ja siinä on käytännössä uudistettu kaikki. Mikäli haikailet vanhaan takaisin niin se löytyy osoitteesta <a href="https://vanha.tapaaminen.net">vanha.tapaaminen.net</a>.
                    </div>
                </article>
                <article class="message is-success">
                    <div class="message-body">
                        <nav class="level">
                            <div class="level-item has-text-centered">
                                <div>
                                    <p class="heading">Tapaamisia</p>
                                    <p class="title">{{ $meetingcount }}</p>
                                </div>
                            </div>
                            <div class="level-item has-text-centered">
                                <div>
                                    <p class="heading">Käyttäjiä</p>
                                    <p class="title">{{ $usercount }}</p>
                                </div>
                            </div>
                            <div class="level-item has-text-centered">
                                <div>
                                    <p class="heading">Ilmottautumisia</p>
                                    <p class="title">{{ $registrationcount }}</p>
                                </div>
                            </div>
                            <div class="level-item has-text-centered">
                                <div>
                                    <p class="heading">Kommentteja</p>
                                    <p class="title">{{ $commentcount }}</p>
                                </div>
                            </div>
                        </nav>
                    </div>
                </article>
            </div>
        </div>


@endsection
