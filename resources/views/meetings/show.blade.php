@extends('layouts.app')

@section('content')

    @if(Auth::Check())
        @if(Auth::User()->id == $meeting->user_id)
            <article class="message is-primary">
                <div class="message-body">
                    Olet tämän tapaamisen luoja, joten sinulla on myös oikeus hallita tätä tapaamista.
                    <a style="text-decoration: none;" href="{{ url('/a/'.$meeting->adminslug) }}" class="button is-danger is-outlined is-small is-pulled-right">Mene hallintaan</a>
                </div>
            </article>
        @endif
    @endif

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
        <br />
        <small>Viimeksi päivitetty: {{ $meeting->updated_at->format('d.m.Y H:i:s') }}</small>
    </div>

    <?php if(Auth::Check()){ $defaultname = Auth::User()->name; $defaultemail = Auth::User()->email; }else{ $defaultname = ""; $defaultemail = ""; } ?>

    <div class="box" id="registration">
        <h3 class="title is-4">Ilmottaudu</h3>

        {{ dump($meeting->times) }}
    </div>

    @if($meeting->settings->comments)
        <div class="box" id="comments">
            <h3 class="title is-4">Keskustelu</h3>
            @if(count($meeting->comments) == 0)
                Ei kommentteja!
            @endif

            @foreach($meeting->comments as $comment)
                <div class="box bbs-post" id="{{ $comment->id }}">
                    <article class="media">
                        <figure class="media-left">
                            <p class="image is-64x64">
                                <img src="https://www.gravatar.com/avatar/{{ md5( strtolower( trim( $comment->email ) ) ) }}?d=wavatar&img=false&s=128">
                            </p>
                        </figure>
                        <div class="media-content">
                            <div class="post-meta">
                                <strong>{{ $comment->username }}</strong>
                                <small>
                                    <a class="is-pulled-right" style="color:#4a4a4a;" href="{{ url('/s/'.$meeting->slug.'#'.$comment->id) }}">{{ $comment->created_at->diffForHumans() }}</a>
                                </small>
                            </div>
                            <div class="content">
                                {!! $comment->comment !!}
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach

            <hr />
            @include('layouts.errors')
            <article class="media">
                <div class="media-content">
                    <form role="form" method="POST" action="{{ url('/s/'.$meeting->slug) }}">
                        {{ csrf_field() }}
                        <label class="label">Nimesi</label>
                        <p class="control">
                            <input type="text" name="username" class="input" placeholder="Nimesi" value="{{ old('username', $defaultname) }}">
                        </p>
                        <label class="label">Sähköpostisi <small>(ei julkaista)</small></label>
                        <p class="control">
                            <input type="email" name="email" class="input" placeholder="Sähköpostisi" value="{{ old('email', $defaultemail) }}">
                        </p>
                        <label class="label">Kommenttisi</label>
                        <p class="control">
                            <textarea class="textarea" name="comment" placeholder="Kommentoi">{{ old('username') }}</textarea>
                        </p>
                        @if(Auth::guest())
                            <label class="label">Ihmisyystarkastus</label>
                            <p class="control"><div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITEKEY') }}"></div><br /></p>
                        @endif
                        <nav class="level">
                            <div class="level-left">
                                <div class="level-item">
                                    <p class="control">
                                        <button type="submit" class="button is-info">Kommentoi</button>
                                    </p>
                                </div>
                            </div>
                            <div class="level-right">
                                <div class="level-item">
                                    <label class="checkbox">
                                        Keskustelu tukee markdown syntaksia.
                                    </label>
                                </div>
                            </div>
                        </nav>
                    </form>
                </div>
            </article>
        </div>
    @endif

@endsection