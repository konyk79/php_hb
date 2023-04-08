    <div class="container flex-clearfix">
        <button class="toggle-btn">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a href="" class="logo"><img src="/img/logo.png" alt="logo"></a>
        <ul class="menu wow fadeIn">
        @if($menu)
            @foreach($menu->getItems() as $item)
                @if($item->subitems->count()==0)
                        <li><a target="{{$item->href_type}}" href="{{$item->href}}">{{$item->title}}</a></li>
                @else
                        <li class="dropdown">
                            <a href="{{$item->href}}">{{$item->title}}<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($item->getSubitems() as $subitem)
                                    <li><a  target="{{$subitem->href_type}}" href="{{$subitem->href}}">{{$subitem->title}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                @endif
            @endforeach
        @endif
        </ul>
    </div>