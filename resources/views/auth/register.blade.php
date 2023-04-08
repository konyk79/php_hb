{{--@extends('dashboard.layouts.app')--}}

{{--@section('content')--}}
<!--   this view blade template for model App\Page
* you can get access to current obgect of model via
* $page
-->
<!--   start include @content... directives
* $self  - must point to model of this html view's entity to make possible use @content... directives
* to include insert such php string
*  $self= $objectOfModel;
* and take care that you Model has getContentByName() method
-->
@php
    $self=$page;

$currentUser = Auth::user();
@endphp
<!--   endinclude @content... directives --><!--Start content-->
<!--Start content-->
<main class="content">
    <div class="container">
        <div class="title">{{$page->title}}</div>
        @if ($forms=$page->forms)
            @php
                $form=$forms[0];
            @endphp
            @includeIfExist($form->getViewName(),['form'=>$form])
        @endif
    </div>
</main>
<!--End content-->


{{--<div class="container">--}}
{{--<div class="row">--}}
{{--<div class="col-md-8 col-md-offset-2">--}}
{{--<div class="panel panel-default">--}}
{{--<div class="panel-heading">Register</div>--}}

{{--<div class="panel-body">--}}
{{--<form class="form-horizontal" method="POST" action="{{ route('register') }}">--}}
{{--{{ csrf_field() }}--}}

{{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
{{--<label for="name" class="col-md-4 control-label">Name</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}

{{--@if ($errors->has('name'))--}}
{{--<span class="help-block">--}}
{{--<strong>{{ $errors->first('name') }}</strong>--}}
{{--</span>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
{{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

{{--@if ($errors->has('email'))--}}
{{--<span class="help-block">--}}
{{--<strong>{{ $errors->first('email') }}</strong>--}}
{{--</span>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
{{--<label for="password" class="col-md-4 control-label">Password</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="password" type="password" class="form-control" name="password" required>--}}

{{--@if ($errors->has('password'))--}}
{{--<span class="help-block">--}}
{{--<strong>{{ $errors->first('password') }}</strong>--}}
{{--</span>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--<div class="col-md-6 col-md-offset-4">--}}
{{--<button type="submit" class="btn btn-primary">--}}
{{--Register--}}
{{--</button>--}}
{{--</div>--}}
{{--</div>--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
