@extends('master')

@section('content')
	<div class="row">
		<div class="col s12 m6 offset-m3">
			<div class="card orange darken-3">
				<div class="card-content">
					<div>
						<a href="{{ route('home') }}" class="btn grey darken-2"><i class="mdi-hardware-keyboard-arrow-left left"></i>Tillbaka</a>
					</div>
					<span class="card-title">Redigera tips</span>
					<div class="row">
						{!! Form::model($game, ['route' => ['games.update', $game->id], 'method' => 'put', 'class' => 'col s12 white']) !!}

							{!! Form::hidden('game-type', $game->game_type) !!}
							<div class="input-field col s12">
								{!! Form::text('name') !!}
							</div>
                            <div class="input-field col s12">
                            	{!! Form::number('price') !!}
                            </div>
                            <div class="input-field col s12">
                            	@if($game->game_type == 'LeagueTable')
	                            	<ol>
									@foreach(unserialize($game->game_data) as $team)
										<li>{!! Form::text('game-data[]', $team) !!}</li>
									@endforeach
									</ol>
								@elseif($game->game_type == 'Results')
									<table>
										<tbody>
										@for($i = 0; $i < count($game->game_data['matches']); $i++)
											<tr>
												<td>
													<input type="text" name="game_data[matches][{{$i}}][match]" value="{{ $game->game_data['matches'][$i]['match'] }}">
													<input type="hidden" name="game_data[matches][{{$i}}][worth]" value="{{ $game->game_data['matches'][$i]['worth']}}">
													@if(isset($game->game_data['matches'][$i]['highlighted']))
														<input type="hidden" name="game_data[matches][{{$i}}][highlighted]" value="{{ $game->game_data['matches'][$i]['highlighted'] }}">
													@endif
												</td>
												@foreach(array('0' => 'Inget','1' => '1','X' => 'X','2' => '2') as $result => $label)
													<?php
													$value = '0';
													if (isset($game->game_data['matches'][$i]['correct'])) {
														$value = $game->game_data['matches'][$i]['correct'];
													}
													?>
													<td>
														<input type="radio" @if($value == $result) checked="checked" @endif id="matches-{{$i}}-{{$result}}" name="game_data[matches][{{$i}}][correct]" value="{{$result}}">
														<label for="matches-{{$i}}-{{$result}}">{{ $label }}</label>
													</td>
												@endforeach
											</tr>
										@endfor
										</tbody>
									</table>
								@endif
                            </div>
                            <div class="input-field col s12">
                            	{!! Form::select('status', $statuses, $game->status, ['class' => 'browser-default']) !!}
                            </div>
                            <div class="input-field col s12">
                            	@if(count($game->predictions) != 0)
								<ul class="collection">
									@foreach($game->predictions as $prediction)
										<li class="collection-item avatar">
											<img src="{{ $prediction->user->profile_picture_thumbnail }}" class="circle">
											<span class="title">{{ $prediction->user->username }} har tippat:</span>
											@if($game->game_type == 'LeagueTable')
											<ol>
												@foreach(unserialize($prediction->prediction) as $team)
													<li>{{ $team }}</li>
												@endforeach
											</ol>
											@else
												<strong>{{ $prediction->prediction }}</strong>
											@endif
											<p>
												{!! Form::radio('winner', $prediction->id, false, ['id' => 'winner_'.$prediction->id]) !!}
												{!! Form::label('winner_'.$prediction->id, 'Vinnare') !!}
											</p>
										</li>
									@endforeach
								</ul>
								@endif
                            </div>
							<div class="input-field col s12">
								{!! Form::submit('Spara', ['class' => 'btn orange']) !!}
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop