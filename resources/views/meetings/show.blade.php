@extends('layouts.app')

@section('content')

    @if(Auth::Check())
        @if(Auth::User()->id == $meeting->user_id && !$admin)
            <article class="message is-primary">
                <div class="message-body">
                    Olet tämän tapaamisen luoja, joten sinulla on myös oikeus hallita tätä tapaamista.
                    <a style="text-decoration: none;" href="{{ url('/a/'.$meeting->adminslug) }}" class="button is-danger is-outlined is-small is-pulled-right">Mene hallintaan</a>
                </div>
            </article>
        @endif
    @endif

    @if($admin)
        <article class="message is-danger">
            <div class="message-body">
               Olet tapaamisen hallintanäkymässä.
                <a style="text-decoration: none;" href="{{ url('/s/'.$meeting->slug) }}" class="button is-success is-outlined is-small is-pulled-right">Mene tapaamiseen</a>
            </div>
        </article>
    @endif

    @if($admin)
        @include('meetings.partials.basic-edit')
    @else
        @include('meetings.partials.basic-show')
    @endif

    @if($admin)
        @include('meetings.partials.settings-edit')
    @endif

    <?php if(Auth::Check()){ $defaultname = Auth::User()->name; $defaultemail = Auth::User()->email; }else{ $defaultname = ""; $defaultemail = ""; } ?>

    @if($admin)
        @include('meetings.partials.registrations-edit')
    @else
        @include('meetings.partials.registrations-show')
    @endif

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

                                @if($admin)
                                    <form role="form" method="POST" action="{{ url('/a/'.$meeting->adminslug.'/comments') }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="comment" value="{{ $comment->id }}" />
                                        <button type="submit" class="button is-danger is-small is-outlined">Poista kommentti</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
            @if(!$admin)
                <hr />
                @include('layouts.errors')
                <article class="media">
                    <div class="media-content">
                        <form role="form" method="POST" action="{{ url('/s/'.$meeting->slug) }}">
                            {{ csrf_field() }}
                            <div class="columns">
                                <div class="column is-half">
                                    <div class="field">
                                        <label class="label">Nimesi</label>
                                        <p class="control">
                                            <input type="text" name="username" class="input" placeholder="Nimesi" value="{{ old('username', $defaultname) }}" required>
                                        </p>
                                    </div>

                                    <div class="field">
                                        <label class="label">Sähköpostisi <small>(ei julkaista)</small></label>
                                        <p class="control">
                                            <input type="email" name="email" class="input" placeholder="Sähköpostisi" value="{{ old('email', $defaultemail) }}" required>
                                        </p>
                                    </div>
                                </div>
                                <div class="column is-half">
                                    @if(Auth::guest())
                                        <div class="field">
                                            <label class="label">Ihmisyystarkastus</label>
                                            <p class="control"><div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITEKEY') }}"></div><br /></p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Kommenttisi</label>
                                <p class="control">
                                    <textarea class="textarea" name="comment" placeholder="Kommentoi">{{ old('username') }}</textarea>
                                </p>
                            </div>

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
            @endif
        </div>
    @endif

@endsection