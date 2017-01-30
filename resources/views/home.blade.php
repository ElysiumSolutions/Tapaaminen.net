@extends('layouts.app')

@section('content')
    <form method="post" action="{{ url('/') }}">
        {{ csrf_field() }}
        <div class="is-hidden-tablet" style="margin-bottom:1em;">
            @include('layouts.frontsidebar')
        </div>

        <div class="columns">
            <div class="column is-half">
                <h2 class="title is-3">Luo tapaaminen</h2>

                <label class="label">Tapaamisen nimi <small>(esim. Lounas, Palaveri)</small></label>
                <p class="control">
                    <input class="input" name="name" type="text" placeholder="Anna tapaamisen nimi" required autofocus>
                </p>

                <label class="label">Tapaamisen kuvaus <small>(valinnainen)</small></label>
                <p class="control">
                    <textarea name="description" class="textarea" placeholder="Anna tapaamisen kuvaus"></textarea>
                </p>

                <label class="label">Sijainti <small>(valinnainen)</small></label>
                <p class="control">
                    <input class="input" name="location" type="text" placeholder="Anna tapaamisen sijainti">
                </p>

                <label class="label">Nimesi</label>
                <p class="control">
                    <input class="input" name="organizer" type="text" placeholder="Anna nimesi" required>
                </p>

                <label class="label">Sähköpostisi <small>(saat sähköpostiisi tapaamisen linkit)</small></label>
                <p class="control">
                    <input class="input" name="email" type="email" placeholder="Anna sähköpostisi" required>
                </p>

            </div>
            <div class="column is-half is-hidden-mobile">
                @include('layouts.frontsidebar')
            </div>
        </div>
    </form>
@endsection
