@extends('master')

@section('content')
    <h1>New Category Form</h1>

    <form method="POST" action="{{action('CategoryController@store')}}">
        @include('partials.categoriesForm',
        ['buttonName' => 'Create',
         'name' => old('name'),
         'description' => old('description')])
    </form>
    @include('partials.errors')
@endsection
