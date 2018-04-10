@extends('layouts.app')

@section('content')

    <div class="box">
        <h2 class="title is-3">Lisää aikoja tapaamiseen</h2>

        <p>Voit lisätä uusia aikoja tapaamiseen. Ajan lisäys osaa lisätä ajat fiksusti ja voit lisätä jo olemassa olevalle päivälle aikoja. Ajan lisäys ei lisää samalle päivälle samoja aikoja, kuin mitä on jo olemassa.</p>

        <p><br /></p>
        
        <form method="post" action="{{ url('/a/'.$meeting->adminslug.'/times/add') }}">
            {{ csrf_field() }}

            @include('layouts.errors')

            <h3 class="title is-5">Tapaamisen ajankohdat</h3>

            <div class="field">
                <label class="label">Valitse päivä</label>
                <div id="meeting-calendar"></div>
                <input type="hidden" name="dates" id="dates" value="{{ old('dates') }}">
                <input type="hidden" name="column-amount" id="column-amount" value="{{ old('column-amount', 12) }}">
            </div>

            <div class="field">
                <label class="label">Syötä haluamasi ajat</label>
                <table class="table is-striped" id="time-table">
                    <thead>
                        <tr>
                            <th>Päivä</th>
                            <th style="text-align: center;">Aika 1</th>
                            <th style="text-align: center;">Aika 2</th>
                            <th style="text-align: center;">Aika 3</th>
                            <th style="text-align: center;">Aika 4</th>
                            <th style="text-align: center;">Aika 5</th>
                            <th style="text-align: center;">Aika 6</th>
                            <th style="text-align: center;">Aika 7</th>
                            <th style="text-align: center;">Aika 8</th>
                            <th style="text-align: center;">Aika 9</th>
                            <th style="text-align: center;">Aika 10</th>
                            <th style="text-align: center;">Aika 11</th>
                            <th style="text-align: center;">Aika 12</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
    
                    </tbody>
                </table>
            </div>

            <div class="field">
                <p class="control">
                    <button type="submit" class="button is-success">Lisää ajat</button>
                    <a class="button is-light" href="{{ url('/a/'.$meeting->adminslug) }}">Peruuta</a>
                </p>
            </div>
        </form>
    </div>

@endsection