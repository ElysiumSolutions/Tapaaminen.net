@extends('layouts.app')

@section('content')

    <div class="box">
        <h2 class="title is-3">Poista aikoja tapaamisesta</h2>

        <p>Voit poistaa aikoja tapaamisesta. Huomaa kuitenkin, että ajan poistaminen - poistaa myös ilmoittautumisen!</p>

        <p><br /></p>
        
        <form method="post" action="{{ url('/a/'.$meeting->adminslug.'/times/remove') }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            @include('layouts.errors')

            <h3 class="title is-5">Valitse poistettavat ajat</h3>

            @foreach($meeting->times as $time)
                <div class="field">
                    <label class="checkbox">
                        <input type="checkbox" name="times[]" value="{{ $time->id }}">
                        {{ $time->day->format( 'd.m.Y' ) }}
                        -
                        {{ $time->time == '' ? 'Koko' : $time->time }}
                    </label>
                </div>
            @endforeach

            <div class="field">
                <p class="control">
                    <button type="submit" class="button is-danger">Poista ajat</button>
                    <a class="button is-light" href="{{ url('/a/'.$meeting->adminslug) }}">Peruuta</a>
                </p>
            </div>
        </form>
    </div>

@endsection