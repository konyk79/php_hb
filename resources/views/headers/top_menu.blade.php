<!--   this view blade template for model App\Header
* uou can get access to current obgect of model via
* $header
-->
<!--   start include @content... directives
* $self  - must point to model of this html view's entity to make possible use @content... directives
* to include insert such php string
*  $self= $objectOfModel;
* and take care that you Model has getContentByName() method
-->
@php $self=$header @endphp
<!--   endinclude @content... directives -->
@php
    $user=Auth::user();
    $isAuthenticated= !is_null($user);
@endphp
<div class="header-top text-right">
    <div class="container">
        <div class="login dropdown">
            <a href="" class="dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span class="icon   @if($isAuthenticated) logout-icon @else login-icon @endif"></span>
                @if($isAuthenticated) {{$user->name}} {{$user->last_name}} @else @contentText('dashboard') @endif
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                @if($isAuthenticated)
                    <li><a href="{{url('/dashboard/profile')}}">@contentText('dashboard')</a></li>
                    <li>             <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            @contentText('logout_text')
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @else
                    <li><a href="{{route('login')}}">@contentText('sign_in_text')</a></li>
                    <li><a href="{{route('register')}}">@contentText('sign_up_text')</a></li>
                @endif
            </ul>
        </div>
        <div class="language dropdown">
            <a href="" class="btn-language dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span class="icon language-icon"></span>{{App\Language::getCurrentLanguageForSwitcher()}} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                @foreach(App\Language::all() as $lang)
                    <li><a href="{{ route('change.language', $lang->code) }}">{{$lang->switcher_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>