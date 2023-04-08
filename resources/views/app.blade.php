@extends($page->layout->getViewName(),['page'=>$page ])

@section('page_headers')
    @if ($page)
       @foreach($page->headers as $header)
           @includeIfExist($header->getViewName())
       @endforeach
    @endif
@endsection

@section('content')
    @if ($page)
        @if(isset($news))
            @includeIfExist($page->getViewName(), ['page' => $page, 'news'=>$news])
        @else
            @includeIfExist($page->getViewName())
        @endif
    @endif
@endsection

@section('page_footers')
    @if ($page)
        @foreach($page->footers as $footer)
            @includeIfExist($footer->getViewName())
        @endforeach
    @endif
@endsection