@extends('master')

@section('content')
    <h1>All Categories</h1>
    @foreach($categories as $category)
        Id: {{ $category->id }} <br>
        Name: {{ $category->name }}<br>
        Description: {{ $category->description }}<br><br>
        @auth
            <a href="{{ action('CategoryController@edit', $category->id) }}">[Edit]</a>
            <form method="POST" action="{{ action('CategoryController@destroy', $category->id) }}">
                @method('DELETE')
                @csrf
                <input type="submit" value="Delete">
            </form>
        @endauth
    @endforeach
@endsection
