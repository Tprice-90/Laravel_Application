@extends('master')

@section('title', 'Contact')

@section('content')

    <h1>Contact Page</h1>
    @if($email)
        {{ $email }}
    @else
        No email address given.
    @endif

@endsection

