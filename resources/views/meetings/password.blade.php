@extends('layouts.app')

@section('content')

    <div class="box">
        <h2 class="title is-3">Salasana vaaditaan</h2>
        <h3 class="subtitle is-5">Tämän tapaamisen luoja on suojannut tapaamisen salasanalla. Sinun pitää syöttää salasana, jotta pääset tutkimaan tapaamisen tietoja tarkemmin.</h3>

        <form method="post" action="{{ url('/s/'.$meeting->slug.'/password') }}">
            {{ csrf_field() }}

            @include('layouts.errors')

            <div class="field">
                <label class="label">Salasana</label>
                <p class="control">
                    <input class="input" name="password" type="password" value="" placeholder="Syötä salasana" required autofocus>
                </p>
            </div>

            <div class="field">
                <p class="control"><button type="submit" class="button is-success">Jatka</button></p>
            </div>
        </form>

    </div>

@endsection