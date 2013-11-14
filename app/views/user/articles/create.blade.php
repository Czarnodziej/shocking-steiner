@extends('layouts.base')
@section('main_content')
<h2>Utwórz nowy artykuł:</h2>
{{ Notification::showAll() }}
{{ Form::open(array('route' => 'użytkownik.teksty.store')) }}

    <div>
        {{ Form::label('title', 'Tytuł') }}
        <div>
            {{ Form::text('title') }}
        </div>
    </div>

    <div>
        {{ Form::label('body', 'Zawartość:') }}
        <div>
            {{ Form::textarea('body') }}
        </div>
    </div>

    <div>
        {{ Form::submit('Zapisz') }}
        <a href="{{ URL::route('użytkownik.teksty.index') }}">Anuluj</a>
    </div>

{{ Form::close() }}

@stop