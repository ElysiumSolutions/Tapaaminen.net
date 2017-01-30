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
                Ketjuja: {{ Auth::User()->threads->count() }} kpl<br />
                Viestejä: {{ Auth::User()->posts->count() }} kpl<br />
                Tapaamisia: {{ Auth::User()->meetings->count() }} kpl
            </div>
        </article>
    </div>
@endif