@if ($user)
    @php
        if($user){
            $photo = $user->photo;
            $filename = 'default-user-image.png/';
            if(!is_null($photo)) {
                $filename = $user->photo . "/";
            }
        }

    @endphp
    <li>
        <a href="/" target="_blank">
            <i class="fa fa-btn fa-globe"></i> @lang('sleeping_owl::lang.links.index_page')
        </a>
    </li>
    <li class="dropdown user user-menu" style="margin-right: 20px;">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
            <img src="{{url('/dashboard/users/getImage/'.$filename)}}" class="user-image" />
            <span class="hidden-xs">{{ $user->name }}</span>
        </a>
        <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
                <img src="{{url('/dashboard/users/getImage/'.$filename)}}" class="img-circle" />

                <p>
                    {{ $user->name }}
                    <small>@lang('sleeping_owl::lang.auth.since', ['date' => $user->created_at->format('d.m.Y')])</small>
                </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
                <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-btn fa-sign-out"></i> @lang('sleeping_owl::lang.auth.logout')
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </li>
    <li class=" dropdown">
            <a href="" class="btn-language dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span class="icon language-icon"></span>{{App\Language::getCurrentLanguageForSwitcher()}} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                @foreach(App\Language::all() as $lang)
                    <li><a style="color:white!important; " href="{{ route('change.language', $lang->code) }}">{{$lang->switcher_name}}</a></li>
                @endforeach
            </ul>
    </li>
    <li><span>&nbsp;&nbsp;&nbsp;</span></li>
@endif