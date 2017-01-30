@extends('layouts.app')

@section('content')

    <div class="columns">
        <div class="column is-two-thirds">
            <h3 class="title">Aloita uusi keskustelu</h3>
            @if (Auth::guest())
                <div class="notification">
                    Voidaksesi osallistua keskustelun, pitää sinun luoda ensin tunnus. Tällä estämme roskapostia ja pidämme keskustelun siistinä.<br /><br />
                    <a href="{{ url('/luo-tili') }}" class="button is-info">Luo tili</a>
                    <a href="{{ url('/kirjaudu') }}" class="button is-success">Kirjaudu sisään</a>
                </div>
            @else
                <form role="form" method="POST" action="{{ url('/palsta') }}">
                    {{ csrf_field() }}

                    <label class="label">Otsikko</label>
                    <p class="control">
                        <input class="input is-large" type="text" name="title" placeholder="Kirjoita kuvaava otsikko" autofocus>
                    </p>

                    <label class="label">Teksti</label>
                    <p class="control">
                        <textarea id="palsta-tinymce" class="textarea" name="message" placeholder="Kirjoita tekstisi tähän"></textarea>
                    </p>

                    @include('layouts.errors')

                    <div class="control is-grouped">
                        <p class="control">
                            <button type="submit" class="button is-info">Aloita keskustelu</button>
                        </p>
                        <p class="control">
                            <a href="{{ url()->previous() }}" class="button is-link">Peruuta</a>
                        </p>
                    </div>
                </form>
            @endif
        </div>
        <div class="column is-one-third">
            @include('thread.sidebar')
        </div>
    </div>
@endsection