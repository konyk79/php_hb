@extends('email.templates.sunny')

@section('content')

    @include ('email.templates.sunny.heading' , [
        'heading' => __('emails.common_heading'),
        'level' => 'h1',
    ])

    @include('email.templates.sunny.contentStart')

    <p>@lang('emails.beautymail_firstpassword_thank_you')</p>
    <p>@lang('emails.common_confidential_info')</p>
    <p style="margin-left: 15px">
        <b>@lang('emails.common_email')</b> {{$user->email}}<br>
        <b>@lang('emails.common_password')</b> {{$password}}
    </p>
    <p>@lang('emails.beautymail_firstpassword_change_password_text')</p>

    @include('email.templates.sunny.contentEnd')

    @include('email.templates.sunny.contentStart')
    <p>@lang('emails.beautymail_email_confirmation_explanation')</p>
    <p style="font-size: 11px;">@lang('emails.beautymail_email_confirm_text')</p>
    <p style="text-align: center;font-size: 11px"><a href="{{url('/confirm/' . $user->email_confirmation_code)}}">{{url('/confirm/' . $user->email_confirmation_code)}}</a></p>
    <p>@lang('emails.common_confidential_info')</p>
    <p>@lang('emails.common_confidential_info')</p>

{{--    <p>@lang('common.support_text')</p>--}}

    @include('email.templates.sunny.contentEnd')
@stop
