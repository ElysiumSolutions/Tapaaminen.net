@extends('layouts.app')

@section('content')

    <div class="columns">
        <div class="column is-two-thirds">
            <nav class="level">
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Keskusteluita</p>
                        <p class="title">{{ $threadcount }}</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Viestejä</p>
                        <p class="title">{{ $messagecount }}</p>
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
                        <p class="heading">Tykkäyksiä</p>
                        <p class="title">{{ $likecount }}</p>
                    </div>
                </div>
            </nav>

            <hr />

            @foreach($threads as $thread)
                <article class="media thread">
                    <figure class="media-left">
                        <p class="image is-64x64">
                            <img src="https://www.gravatar.com/avatar/{{ md5( strtolower( trim( $thread->user->email ) ) ) }}?d=wavatar&img=false&s=128">
                        </p>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <h4 class="title is-4"><a href="{{ url('/palsta/'.$thread->slug) }}">{{ $thread->title }}</a></h4>
                            <h5 class="subtitle is-6"><a href="#">{{ "@".$thread->user->username }}</a> &bull; {{ $thread->created_at->diffForHumans() }}</h5>
                            <p>{{ \Illuminate\Support\Str::words(strip_tags($thread->posts[0]->message), 30) }}</p>

                            <small>
                                @if(count($thread->posts) > 1)
                                    Uusin vastaus {{ $thread->updated_at->diffForHumans() }} &bull;
                                @endif
                                @if(count($thread->posts)-1 == 0)
                                    Ei vastauksia &bull;
                                @else
                                    {{ count($thread->posts)-1 }} vastausta &bull;
                                @endif
                                @if($thread->posts[0]->likes == 0)
                                    Ei tykkäyksiä
                                @else
                                    {{ $thread->posts[0]->likes }} tykkäystä
                                @endif
                            </small>
                        </div>
                    </div>
                </article>
            @endforeach

            <hr />

            {{ $threads->links() }}
        </div>
        <div class="column is-one-third">
            @include('thread.sidebar')
        </div>
    </div>
@endsection