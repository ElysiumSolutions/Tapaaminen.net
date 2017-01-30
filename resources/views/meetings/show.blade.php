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

    {{ dump($meeting) }}

@endsection