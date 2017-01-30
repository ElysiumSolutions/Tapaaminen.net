@extends('layouts.app')

@section('content')

    <h2 class="title is-3">
        Moikka {{ Auth::User()->name }}!
        <a href="{{ url('/oma-tili/muokkaa') }}" class="button is-info is-pulled-right">Muokkaa omia tietoja</a>
    </h2>

    <div class="columns">
        <div class="column is-one-third">
            <nav class="panel">
                <p class="panel-heading">
                    Omat tapaamiset
                </p>

                @if(count($meetings) == 0)
                    <div class="panel-block">Ei tapaamisia!</div>
                @else
                    @foreach($meetings as $meeting)
                        <a class="panel-block" href="{{ url('/s/'.$meeting->slug) }}">
                            <span class="panel-icon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            {{ $meeting->name }}
                        </a>
                    @endforeach
                @endif
            </nav>
        </div>
        <div class="column is-one-third">
            <nav class="panel">
                <p class="panel-heading">
                    Omat ilmottautumiset
                </p>

                @if(count($registrations) == 0)
                    <div class="panel-block">Ei ilmottautumisia!</div>
                @else
                    @foreach($registrations as $registration)
                        <a class="panel-block" href="#">
                            <span class="panel-icon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            {{ dump($registration) }}
                        </a>
                    @endforeach
                @endif
            </nav>
        </div>
        <div class="column is-one-third">
            <nav class="panel">
                <p class="panel-heading">
                    Ilmoitukset
                </p>

                @if(count($notifications) == 0)
                    <div class="panel-block">Ei ilmoituksia!</div>
                @else
                    @foreach($notifications as $notification)
                        <a class="panel-block" href="#">
                            <span class="panel-icon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            {{ dump($notification) }}
                        </a>
                    @endforeach
                @endif
            </nav>
        </div>
    </div>

@endsection