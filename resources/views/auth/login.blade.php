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
@php $self=$page;
date_default_timezone_set("UTC");
@endphp

<!--   endinclude @content... directives --><!--Start content-->
<!--Start content-->
<main class="content">
    <div class="container">
        <div class="title">{{$page->title}}</div>
        <form action="{{ route('login') }}" method="POST"  class="main-form">
            {{ csrf_field() }}
            <input type='hidden' id="timezone" name='timezone' value = 'UTC'>
            <input type='hidden' id="timezone_offset" name='timezone_offset' value = '0'>
            <div class="{{ $errors->has('email') ? ' has-error' : '' }} form-group">
                <input type="email" name="email" placeholder="@contentText('login_email_placeholder')" class="form-control">
                @if ($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif

            </div>
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" name="password" placeholder="@contentText('login_pass_placeholder')" class="form-control">
                @if ($errors->has('password'))
                    <div class="text-danger">{{ $errors->first('password') }}</div>
                @endif
            </div>
            {{--<div class="form-group">--}}
                {{--<a href="@contentHref('login_contact_us')" class="button btn-black full-width height-control">@contentHrefText('login_contact_us')</a>--}}
            {{--</div>--}}
            <div class="form-group flex-block align-items-center justify-content-space-beetwen">
                <div class="checkbox">
                    <input id="checkbox1" type="checkbox" name="remember">
                    <label for="checkbox1">@contentText('login_remember_me')</label>
                </div>
                <button class="button btn-blue" type="submit">@contentText('login_submit')</button>
            </div>
            {{--<div class="form-group">--}}
            {{--<a href="{{url('login/facebook')}}" class="button btn-black full-width height-control">facebook</a>--}}
            {{--</div>--}}
        </form>
    </div>
</main>
<!--End content-->

{{--@section('content')--}}
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Login</div>--}}

                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" method="POST" action="{{ route('login') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>--}}

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
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-8 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Login--}}
                                {{--</button>--}}

                                {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                    {{--Forgot Your Password?--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
