@extends('layouts.base')
@section('main_content')
<div>
		{{ Notification::showAll() }}
		{{ Form::open() }}

		@if ($errors->has('login'))
		<div>{{ $errors->first('login', ':message') }}</div>
		@endif

		<div>
				{{ Form::label('email', 'Adres e-mail:') }}
				<div>
						{{ Form::text('email') }}
				</div>
		</div>

		<div>
				{{ Form::label('password', 'Hasło:') }}
				<div>
						{{ Form::password('password') }}
				</div>
		</div>

		<div class="submit-button">
				{{ Form::submit('Zaloguj')}}
		</div>

		{{ Form::close() }}
</div>

@stop