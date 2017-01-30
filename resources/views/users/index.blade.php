@extends('layouts.app')

@section('content')

    <h2 class="title is-3">
        Moikka {{ Auth::User()->name }}!
        <a href="{{ url('/oma-tili/muokkaa') }}" class="button is-info is-pulled-right">Muokkaa omia tietoja</a>
    </h2>

    <hr />

    <nav class="level">
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Tapaamiset</p>
                <p class="title">233</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Ilmottautumiset</p>
                <p class="title">233</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Kommentit</p>
                <p class="title">123</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Viestit</p>
                <p class="title">222</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Tykkäykset</p>
                <p class="title">789</p>
            </div>
        </div>
    </nav>

    <hr />

    <div class="columns">
        <div class="column is-one-third">
            <div class="box">
                <h3 class="title is-5">Omat tapaamiset</h3>
                @for($i = 0; $i < 3; $i++)
                    <article class="message is-success">
                        <div class="message-body">
                            Tapaamisen infot
                        </div>
                    </article>
                @endfor
            </div>
        </div>
        <div class="column is-one-third">
            <div class="box">
                <h3 class="title is-5">Omat ilmottautumiset</h3>

                @for($i = 0; $i < 3; $i++)
                    <article class="message is-dark">
                        <div class="message-body">
                            Tapaamisen infot
                        </div>
                    </article>
                @endfor
            </div>
        </div>
        <div class="column is-one-third">
            <div class="box">
                <h3 class="title is-5">Ilmoitukset</h3>

                @for($i = 0; $i < 3; $i++)
                    <article class="message is-danger">
                        <div class="message-body">
                            Lipsumia....
                        </div>
                    </article>
                @endfor
            </div>
        </div>
    </div>

@endsection