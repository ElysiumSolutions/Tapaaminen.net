@extends('layouts.app')

@section('content')

    <div class="box">
        <h2 class="title is-3">Lunasta tapaaminen</h2>
        <h3 class="subtitle is-5">Mikäli tiedät tapaamisen hallinnan osoitteen voit liittää sen käyttäjätiliisi. Voit liittää vain sellaisen tapaamisen tiliisi missä ei ole ennestään käyttäjää liitettynä.</h3>

        <form method="post" action="{{ url('/oma-tili/lunasta') }}">
            {{ csrf_field() }}

            @include('layouts.errors')

            <div class="field">
                <label class="label">Tapaamisen hallinnan osoite <small>(esim. https://tapaaminen.net/a/897f473a-6ad1-11e7-8dea-adfa0b5e00bf)</small></label>
                <p class="control">
                    <input class="input" name="adminslug" type="text" placeholder="Syötä hallinnan osoite" value="{{ old('adminslug') }}" required autofocus>
                </p>
            </div>

            <div class="field">
                <p class="control"><button type="submit" class="button is-success">Liitä käyttäjätiliisi</button></p>
            </div>
        </form>

    </div>

@endsection