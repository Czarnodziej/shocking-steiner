@extends('layouts.base')
@section('main_content')
<h2>Edycja tekstów</h2>
{{ Notification::showAll() }}
<form action="{{ URL::route('użytkownik.teksty.create') }}">
    <input type="submit" value="Dodaj nowy tekst">
</form>
<hr>

<table>
    <thead>
        <tr>
            <th>Tytuł</th>
            <th>Utworzony</th>
            <th>Działania</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            {{-- admin can edit any post, user can edit only his/her own --}}
            @if (($article->user_id == Sentry::getUser()->id) || Sentry::getUser()->id == 1)
            <td><a href="{{ URL::route('użytkownik.teksty.show', $article->id) }}">{{ $article->title }}</a></td>
            <td>{{ Daty::showTimeAgo($article->created_at) }}</td>
            <td>
                <div id="crud-buttons">
                    <form action="{{ URL::route('użytkownik.teksty.edit', $article->id) }}">
                        <input type="submit" value="Edytuj">
                    </form>
                    {{ Form::open(array('route' => array('użytkownik.teksty.destroy', $article->id), 'method' => 'delete', 'onsubmit' => 'return confirm(\'Na pewno chcesz usunąć ten artykuł?\')'))}}
                    <button type="submit" href="{{ URL::route('użytkownik.teksty.destroy', $article->id) }}">Usuń</button>
                    {{ Form::close() }}
                </div>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>

@stop