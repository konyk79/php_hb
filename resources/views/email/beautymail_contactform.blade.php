@extends('email.templates.sunny')

@section('content')

    @include ('email.templates.sunny.heading' , [
        'heading' => 'Hello!',
        'level' => 'h1',
    ])

    @include('email.templates.sunny.contentStart')

    <p>Your have question from "{{$email}}" <br>
        name: {{$name}}" <br>
        subject: {{$subject}}</p>
    <p style="font-style: italic">{{$body}}</p>

    @include('email.templates.sunny.contentEnd')
@stop
