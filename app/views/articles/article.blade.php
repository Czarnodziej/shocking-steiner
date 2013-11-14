@extends('layouts.base')
@section('main_content')

<h2>{{ $entry->title }}</h2>
<h4>Utworzony {{ Daty::showTimeAgo($entry->created_at) }} przez {{ $entry->author->email }}</h4>
{{ $entry->body }}
@stop
