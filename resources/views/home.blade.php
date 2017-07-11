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

                @include('layouts.errors')

                <div class="field">
                    <label class="label">Tapaamisen nimi <small>(esim. Lounas, Palaveri)</small></label>
                    <p class="control">
                        <input class="input" name="name" type="text" value="{{ old('name') }}" placeholder="Anna tapaamisen nimi" required autofocus>
                    </p>
                </div>

                <div class="field">
                    <label class="label">Tapaamisen kuvaus <small>(valinnainen)</small></label>
                    <p class="control">
                        <textarea name="description" class="textarea" placeholder="Anna tapaamisen kuvaus">{{ old('description') }}</textarea>
                    </p>
                </div>

                <div class="field">
                    <label class="label">Sijainti <small>(valinnainen)</small></label>
                    <p class="control">
                        <input class="input" name="location" type="text" value="{{ old('location') }}" placeholder="Anna tapaamisen sijainti">
                    </p>
                </div>

                <div class="field">
                    <label class="label">Nimesi</label>
                    <p class="control">
                        <?php if(Auth::Check()){ $defaultname = Auth::User()->name; }else{ $defaultname = ""; } ?>
                        <input class="input" name="organizer" type="text" value="{{ old('organizer', $defaultname) }}" placeholder="Anna nimesi" required>
                    </p>
                </div>

                <div class="field">
                    <label class="label">Sähköpostisi <small>(saat sähköpostiisi tapaamisen linkit)</small></label>
                    <?php if(Auth::Check()){ $defaultemail = Auth::User()->email; }else{ $defaultemail = ""; } ?>
                    <p class="control">
                        <input class="input" name="email" type="email" value="{{ old('email', $defaultemail) }}" placeholder="Anna sähköpostisi" required>
                    </p>
                </div>

            </div>
            <div class="column is-half is-hidden-mobile">
                @include('layouts.frontsidebar')
            </div>
        </div>

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

        @if(Auth::guest())
            <div class="field">
                <label class="label">Ihmisyystarkastus</label>
                <p class="control"><div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITEKEY') }}"></div><br /></p>
            </div>
        @endif

        <div class="field">
            <p class="control"><button type="submit" class="button is-success">Luo tapaaminen</button></p>
        </div>
    </form>
@endsection
