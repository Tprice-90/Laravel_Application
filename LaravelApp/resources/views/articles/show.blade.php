@extends('master')

@section('content')
    <h1>Article # {{$article->id}}</h1>
    Name: {{ $article->name }}<br>
    Body: {{ $article->body }}<br>
    Author Id: {{ $article->author_id }}

    <h2>Belongs to</h2>
    Category: {{ $article->category->name }}<br>
    Description: {{ $article->category->description }}<br>
    <br>Tags:
    @foreach($article->tags as $tag)
        {{$tag->name}}
    @endforeach
    <br><h2>Image</h2>
    @isset($article->file)
        <img src="{{ asset('storage/' . $article->file) }}" width="100px" height="100px"><br>
    @endisset
@endsection
