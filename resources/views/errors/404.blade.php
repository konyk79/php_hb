@extends('errors::layout')

@section('title', 'Page Not Found')

@section('message')
    Sorry, the page you are looking for could not be found.
    <br/><br/>
    <div> <a href="/">To Main Page</a></div>
    <div> <a href="/login">To Sign In</a></div>
@endsection