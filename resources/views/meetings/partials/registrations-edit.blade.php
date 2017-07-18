<div class="box" id="registration">
    <h3 class="title is-4">Muokkaa ilmoittautumisia</h3>
    <form role="form" method="POST" action="{{ url('/a/'.$meeting->adminslug.'/registrations') }}">
        {{ csrf_field() }}
        {{ method_field('delete') }}

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
                <td class="empty" style="text-align: right;">{{ count($meeting->registrations) }} ilmoittautumista</td>
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

            @foreach($meeting->registrations as $registration)
                <tr class="register">
                    <td class="username">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user"></i>
                                </span>
                        {{ $registration->username }}
                    </td>
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

                                    <td class="yes">
                                                <span class="icon is-small">
                                                    <i class="fa fa-check"></i>
                                                </span>
                                    </td>
                                @else
                                    <td class="no">&nbsp;</td>
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach
                    <td>
                        <button name="registration" value="{{ $registration->id }}" class="button is-danger is-small is-outlined">
                            <span class="icon is-small">
                                <i class="fa fa-times"></i>
                            </span>
                            <span>Poista</span>
                        </button>
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
    </form>
</div>