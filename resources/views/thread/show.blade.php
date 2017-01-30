@extends('layouts.app')

@section('content')

    <div class="columns">
        <div class="column is-two-thirds">
            <h2 class="title is-3">{{ $thread->title }}</h2>
            @foreach($thread->posts as $post)
                <div class="box">
                    <article class="media">
                        <figure class="media-left">
                            <p class="image is-64x64">
                                <img src="https://www.gravatar.com/avatar/{{ md5( strtolower( trim( $post->user->email ) ) ) }}?d=wavatar&img=false&s=128">
                            </p>
                        </figure>
                        <div class="media-content">
                            <div class="post-meta">
                                <strong>{{ $post->user->name }}</strong> <small>{{ '@'.$post->user->username }} &bull; {{ $post->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="content">
                                {!! $post->message !!}
                            </div>
                            <nav class="level">
                                <div class="level-left">
                                    <p class="control">
                                        <!--<button class="button is-small is-info is-outlined">
                                            <span class="icon is-small"><i class="fa fa-reply"></i></span>
                                            <span>Vastaa</span>
                                        </button>-->
                                        @if(Auth::check())
                                            <button class="button is-small is-danger is-outlined @if($post->user_id != Auth::User()->id) likeButton @endif" value="{{ $post->id }}" id="post-{{  $post->id }}-button">
                                               <span class="icon is-small"><i class="fa fa-heart"></i></span>
                                               <span id="post-{{  $post->id }}-likecount">{{ $post->likes }}</span>
                                            </button> <span style="display: none; color:#ff3860; font-size:12px;" id="post-{{  $post->id }}-feedback"></span>
                                        @else
                                            <button class="button is-small is-danger is-outlined">
                                                <span class="icon is-small"><i class="fa fa-heart"></i></span>
                                                <span>{{ $post->likes }}</span>
                                            </button>
                                        @endif
                                    </p>
                                </div>
                                <div class="level-right">
                                    <p class="control">
                                        <!--<button class="button is-small is-danger is-outlined">
                                            <span class="icon is-small"><i class="fa fa-exclamation-triangle"></i></span>
                                        </button>-->
                                    </p>
                                </div>
                            </nav>

                        </div>
                    </article>
                </div>
            @endforeach

            @if (Auth::guest())
                <div class="notification">
                    Voidaksesi osallistua keskustelun, pitää sinun luoda ensin tunnus. Tällä estämme roskapostia ja pidämme keskustelun siistinä.<br /><br />
                    <a href="{{ url('/luo-tili') }}" class="button is-info">Luo tili</a>
                    <a href="{{ url('/kirjaudu') }}" class="button is-success">Kirjaudu sisään</a>
                </div>
            @else
                <form role="form" method="POST" action="{{ url('/palsta/'.$thread->slug) }}">
                    {{ csrf_field() }}
                    <article class="media">
                        <figure class="media-left">
                            <p class="image is-64x64">
                                <img src="https://www.gravatar.com/avatar/{{ md5( strtolower( trim( Auth::User()->email ) ) ) }}?d=wavatar&img=false&s=128">
                            </p>
                        </figure>
                        <div class="media-content">
                            <p class="control">
                                <textarea class="textarea" name="message" placeholder="Kommentoi..."></textarea>
                            </p>

                            @include('layouts.errors')

                            <nav class="level">
                                <div class="level-left">
                                    <div class="level-item">
                                        <button type="input" class="button is-info">Kommentoi</button>
                                    </div>
                                </div>
                                <div class="level-right">
                                    <div class="level-item">
                                        Keskustelu tukee markdown syntaksia.
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </article>
                </form>
            @endif
        </div>
        <div class="column is-one-third">
            @include('thread.sidebar')
        </div>
    </div>
@endsection