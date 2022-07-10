@extends('master')

@section('content')
    <h1>All Articles</h1>
    @foreach($articles as $article)
        Id: {{ $article->id }} <br>
        Name: {{ $article->name }}<br>
        Body: {{ $article->body }}<br>
        Author Id: {{ $article->author_id }}<br><br>
    @endforeach
@endsection
