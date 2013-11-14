@extends('layouts.base')
@section('main_content')
<h2>Edycja artykułu</h2>
{{ Notification::showAll() }}
{{ Form::model($article, array('method' => 'put', 'route' => array('użytkownik.teksty.update', $article->id))) }}

<div>
    {{ Form::label('title', 'Tytuł:') }}
    <div>
        {{ Form::text('title') }}
    </div>
</div>

<div>
    {{ Form::label('body', 'Treść:') }}
    <div>
        {{ Form::textarea('body') }}
    </div>
</div>

<div>
    {{ Form::submit('Zapisz') }}
<form action="{{ URL::route('użytkownik.teksty.index') }}">
    <input type="submit" value="Anuluj">
</form>

</div>

{{ Form::close() }}

@stop