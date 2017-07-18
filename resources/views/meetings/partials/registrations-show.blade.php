<div class="box" id="registration">
    <h3 class="title is-4">Milloin sinulle sopisi?</h3>
    <form role="form" method="POST" action="{{ url('/s/'.$meeting->slug.'/times') }}">
        {{ csrf_field() }}
        <table class="table timestable">
            <thead>
            <tr>
                <td class="empty">&nbsp;</td>
                @foreach($times as $month => $days)
                    <td class="month" colspan="{{ $amounts[$month] }}">{{ $meeting->formatMonth($month) }}</td>
                @endforeach
            </tr>
            <tr>
                <td class="empty">&nbsp;</td>
                @foreach($times as $month => $days)
                    @foreach($days as $day => $times2)
                        <td class="day" colspan="{{ count($times2) }}">{{ $meeting->formatDay($day, $month) }}</td>
                    @endforeach
                @endforeach
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
                        @if($meeting->settings->shownames)
                            {{ $registration->username }}
                        @else
                            <i>Piilotettu</i>
                        @endif
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
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr class="registration">
                <td>
                    <div class="field">
                        <p class="control has-icons-left has-icons-right">
							<?php if(Auth::Check()){ $defaultname = Auth::User()->name; }else{ $defaultname = ""; } ?>

                            <input class="input is-small" type="text" name="name" placeholder="Nimesi" value="{{ old('name', $defaultname) }}">
                            <span class="icon is-small is-left">
                                        <i class="fa fa-user"></i>
                                    </span>
                        </p>
                    </div>
                </td>
                @foreach($times as $month => $days)
                    @foreach($days as $day => $times2)
                        @foreach($times2 as $time)
                            <td class="timecell">
                                <div class="field">
                                    <p class="control">
                                        <label class="checkbox">
                                            <input type="checkbox" name="times[]" value="{{ $time['id'] }}">
                                        </label>
                                    </p>
                                </div>
                            </td>
                        @endforeach
                    @endforeach
                @endforeach
            </tr>
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
            <tr>
                <td class="empty">&nbsp;</td>
                <td class="registerbutton" colspan="{{ $k }}">
                    <button type="submit" class="button is-success is-small">ILMOITTAUDU</button>
                    <br /><br />
                    @include('layouts.errors')
                </td>
            </tr>
            </tfoot>
        </table>
    </form>
</div>