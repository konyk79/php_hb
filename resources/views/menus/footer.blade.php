<ul class="footer-menu">
    @if($menu)
        @foreach($menu->getItems() as $item)
            @if($item->subitems->count()==0)
                <li><a target="{{$item->href_type}}" href="{{$item->href}}">{{$item->title}}</a></li>
            @else
                <li class="dropdown">
                    <a href="$item->href" class="dropdown-toggle"
                       data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$item->title}}
                        <span class="caret"></span>
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