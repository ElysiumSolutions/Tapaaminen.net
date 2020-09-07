<div class="box" id="registration">
    <div class="is-pulled-right">
        <a href="{{ url('/a/'.$meeting->adminslug.'/times/add') }}" class="button is-success">Lisää aika</a>
        <a href="{{ url('/a/'.$meeting->adminslug.'/times/remove') }}" class="button is-danger">Poista aika</a>
    </div>
    <h3 class="title is-4">Muokkaa ilmoittautumisia</h3>

    <div id="timestable-wrapper">
        <table class="table timestable">
            <thead>
            <tr>
                <td class="empty">&nbsp;</td>
                @foreach($times as $month => $days)
                    <td class="month" colspan="{{ $amounts[$month] }}">{{ $meeting->formatMonth($month) }}</td>
                @endforeach
                <td class="empty">&nbsp;</td>
            </tr>
            <tr>
                <td class="empty">&nbsp;</td>
                @foreach($times as $month => $days)
                    @foreach($days as $day => $times2)
                        <td class="day" colspan="{{ count($times2) }}">{{ $meeting->formatDay($day, $month) }}</td>
                    @endforeach
                @endforeach
                <td class="empty">&nbsp;</td>
            </tr>
            <tr>
                <td class="empty" style="text-align: right;">{{ count($registrations) }} ilmoittautumista</td>
                @foreach($times as $month => $days)
                    @foreach($days as $day => $times2)
                        @foreach($times2 as $time)
                            <td class="time">{{ $time['time'] }}</td>
                        @endforeach
                    @endforeach
                @endforeach
                <td class="empty">&nbsp;</td>
            </tr>
            </thead>
            <tbody>
            <?php $timeamounts = array(); ?>

            @foreach($registrations as $registration)
                <tr class="register registration">
                    <td class="username">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                        {{ $registration->username }}
                    </td>
                    <form role="form" method="POST" id="regform-{{ $registration->id }}" action="{{ url('/a/'.$meeting->adminslug.'/registrations/update') }}">
                        <input type="hidden" name="registration" value="{{ $registration->id }}" />
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        @foreach($times as $month => $days)
                            @foreach($days as $day => $times2)
                                @foreach($times2 as $time)
                                    @if(in_array($time['id'], json_decode($registration->times)))

                                        <?php
                                        if( ! isset( $timeamounts[ $time['id'] ] ) ) {
                                            $timeamounts[ $time['id'] ] = 0;
                                        }
                                        $timeamounts[$time['id']]++;
                                        ?>

                                        <td class="yes timecell">
                                            <input name="registrations[]" type="checkbox" value="{{ $time['id'] }}" checked style="cursor:pointer;" />
                                        </td>
                                    @else
                                        <td class="no timecell"><input name="registrations[]" value="{{ $time['id'] }}" type="checkbox" style="cursor:pointer;" /></td>
                                    @endif
                                @endforeach
                            @endforeach
                        @endforeach
                    </form>
                    <td style="background:#FFF;">
                        <button type="button" style="margin-right:5px;" class="is-pulled-left button is-success is-small is-outlined" onclick="$('#regform-{{ $registration->id }}').submit();">
                            <span class="icon is-small">
                                <i class="far fa-save"></i>
                            </span>
                            <span>Tallenna</span>
                        </button>
                        <form role="form" method="POST" class="is-pulled-left" action="{{ url('/a/'.$meeting->adminslug.'/registrations') }}">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button name="registration" value="{{ $registration->id }}" class="button is-danger is-small is-outlined" type="submit">
                                <span class="icon is-small">
                                    <i class="fas fa-times"></i>
                                </span>
                                <span>Poista</span>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td class="empty">&nbsp;</td>
                <?php $k = 0; ?>
                @foreach($times as $month => $days)
                    @foreach($days as $day => $times2)
                        @foreach($times2 as $time)
                            <td class="amount">
                                @if(isset($timeamounts[$time['id']]))
                                    {{ $timeamounts[$time['id']] }}
                                @else
                                    0
                                @endif
                            </td>
                            <?php $k++; ?>
                        @endforeach
                    @endforeach
                @endforeach
            </tr>
            </tfoot>
        </table>
    </div>
</div>