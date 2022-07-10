@extends('master')

@section('content')
    <h1>Edit Category<h1>

    <form method="POST" action="{{ action('CategoryController@update', $category->id) }}">
        @method('PUT')
        @include('partials.categoriesForm',
        ['buttonName' => 'Edit',
         'name' => $category->name,
         'description' => $category->description])
    </form>

    @include('partials.errors')
@endsection
