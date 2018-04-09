@extends('layouts.app')

@section('content')

    <div class="box">
        <h2 class="title is-3">Tapaaminen poistettu</h2>
        <h3 class="subtitle is-5">Olet poistanut tämän tapaamisen.</h3>

        <p>Tapahtuiko poistaminen vahingossa? Haluaisitko palauttaa tapaamisen?</p>

        <form method="post" action="{{ url('/a/'.$meeting->adminslug) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="field" style="margin-top:0.75rem;">
                <p class="control">
                    <button type="submit" class="button is-success">
                        <span>Palauta tapaaminen</span>
                    </button>
                </p>
            </div>
        </form>

    </div>

@endsection