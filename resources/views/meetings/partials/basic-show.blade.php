<h2 class="title is-3">{{ $meeting->name }}</h2>
<h3 class="subtitle is-5">{{ $meeting->created_at->diffForHumans() }}</h3>

<div class="box">
    @if($meeting->description != "")
        {{ $meeting->description }}<br />
        <br />
    @endif
    @if($meeting->location != "")
        Tapaamisen sijainti: <strong>{{ $meeting->location }}</strong><br />
        <br />
    @endif
    Tapaamisen loi <strong>{{ $meeting->organizer }}</strong>
    @if($meeting->settings->showemail)
        ja tavoitat hänet sähköpostilla osoitteesta <strong>{{ $meeting->email }}</strong>
    @endif
    .<br />
    @if($meeting->settings->socialmediabuttons)
        <br />
        <a href="http://www.facebook.com/sharer/sharer.php?u={{ url('/s/'.$meeting->slug) }}" class="button is-outlined is-medium is-dark is-outlined hint--top hint--info" target="_blank" aria-label="Facebook">
            <span class="icon is-medium">
                <i class="fa fa-facebook"></i>
            </span>
        </a>
        <a href="https://twitter.com/share?url={{ url('/s/'.$meeting->slug) }}&amp;text=Tapaaminen.net" class="button is-outlined is-medium is-dark is-outlined hint--top hint--info" target="_blank" aria-label="Twitter">
            <span class="icon is-medium">
                <i class="fa fa-twitter"></i>
            </span>
        </a>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url('/s/'.$meeting->slug) }}&title=Tapaaminen.net&summary=&source={{ env('APP_URL') }}" class="button is-outlined is-medium is-dark is-outlined hint--top hint--info" target="_blank" aria-label="LinkedIn">
            <span class="icon is-medium">
                <i class="fa fa-linkedin"></i>
            </span>
        </a>
        <a href="https://plus.google.com/share?url={{ url('/s/'.$meeting->slug) }}" class="button is-outlined is-medium is-dark is-outlined hint--top hint--info" target="_blank" aria-label="Google Plus">
            <span class="icon is-medium">
                <i class="fa fa-google-plus"></i>
            </span>
        </a>
        <a href="whatsapp://send?text=Tapaaminen.net {{ url('/s/'.$meeting->slug) }}" class="button is-outlined is-medium is-dark is-outlined hint--top hint--info" target="_blank" aria-label="Whatsapp">
            <span class="icon is-medium">
                <i class="fa fa-whatsapp"></i>
            </span>
        </a>
        <a href="https://telegram.me/share/url?url={{ url('/s/'.$meeting->slug) }}&amp;text=Tapaaminen.net" class="button is-outlined is-medium is-dark is-outlined hint--top hint--info" target="_blank" aria-label="Telegram">
            <span class="icon is-medium">
                <i class="fa fa-telegram"></i>
            </span>
        </a>
    @endif
</div>