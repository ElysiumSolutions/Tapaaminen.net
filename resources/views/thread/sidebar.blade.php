<a class="button is-success is-outlined is-large" href="{{ url('/palsta/uusi') }}" style="width:100%; margin-bottom:1em;">Uusi keskustelu</a>

@if(Auth::check())
    <div class="box">
        <article class="media">
            <figure class="media-left">
                <p class="image is-64x64">
                    <img src="https://www.gravatar.com/avatar/{{ md5( strtolower( trim( Auth::User()->email ) ) ) }}?d=wavatar&img=false&s=128">
                </p>
            </figure>
            <div class="media-content">
                <strong>{{ Auth::User()->name }}</strong> {{ "@".Auth::User()->username }}<br />

                <a href="{{ url('/oma-tili') }}">Oma tili</a><br />
                <a href="{{ url('/ulos') }}"
                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    Kirjaudu ulos
                </a>

                <form id="logout-form" action="{{ url('/ulos') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </article>
    </div>
@endif

<article class="message is-danger">
    <div class="message-body">
        Kaikki palstalle kirjoitetut viestit ovat julkisia.<br /><strong>Älä</strong> siis jaa henkilökohtaista tietoa tai esimerkiksi tapaamisen hallintalinkkiä täällä.
    </div>
</article>