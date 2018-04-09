@if(config('tapaaminen.notification_text') != "")
    @include('layouts.notification')
@endif
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
        <nav class="level is-mobile">
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Tapaamisia</p>
                    <p class="title">{{ $meetingcount }}</p>
                </div>
            </div>
            <div class="level-item has-text-centered is-hidden-mobile is-hidden-tablet-only">
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
<article class="message is-warning">
    <div class="message-body">
        <div class="content">
            <p><strong>Apua?!</strong><br />
                Kaipaatko kenties apua tapaamisen kanssa? Ei huolta, olemme panostaneet myös siihenkin tällä kertaa.</p>
            <p>
                <ol>
                    <li>Lähetä sähköpostia osoitteeseen apua@tapaaminen.net</li>
                    <li>Liity meidän Slackkiin ja kysy apua #tuki kanavalla</li>
                </ol>
                <a href="mailto:apua@tapaaminen.net" class="button is-dark is-outlined">apua@tapaaminen.net</a>
            </p>
        </div>
    </div>
</article>