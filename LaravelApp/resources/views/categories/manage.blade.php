@extends('master')

@section('content')
    <h1>Deleted Categories</h1>
    @foreach($categories as $category)
        Category Id: {{ $category->id }} <br>
        Name: {{ $category->name }}<br>
        Description: {{ $category->description }}<br><br>
        @auth
            <a href="{{ action('CategoryController@restore', ['category' => $category->id]) }}">[Restore]</a><br>
            <a href="{{ action('CategoryController@forceDelete', ['category' => $category->id]) }}">[Force Delete]</a><br><br>
        @endauth
    @endforeach
@endsection
