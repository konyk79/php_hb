@extends('errors::layout')

@section('title', 'Page Expired')

@section('message')
    The page has expired due to inactivity.
    <br/><br/>
    Please refresh and try again or sign in:
    <br/><br/>
    {{--<div> <a href="/">To Main Page</a></div>--}}
    <div> <a href="/login">To Sign In</a></div>
@stop
