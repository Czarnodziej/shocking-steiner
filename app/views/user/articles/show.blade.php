@extends('layouts.base')
@section('main_content')
<h2>Treść artykułu:</h2>

<hr>

<h3>Tytuł: {{ $article->title }}</h3>
<h5>Utworzony: {{ $article->created_at }}</h5>
{{ $article->body }}
@stop