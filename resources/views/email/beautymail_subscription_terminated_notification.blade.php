@extends('email.templates.sunny')

@section('content')

    @include ('email.templates.sunny.heading' , [
        'heading' => 'Hello!',
        'level' => 'h1',
    ])

    @include('email.templates.sunny.contentStart')

    <p>{{trans('emails.admin_notifications.subscription_terminated_text',['sub_name' => $user_subscription->subscribe->name])}}" <br>
        </p>

    @include('email.templates.sunny.contentEnd')
@stop
