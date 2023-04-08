<!--   start include @content... directives
* $self  - must point to model of this html view's entity to make possible use @content... directives
* to include insert such php string
*  $self= $objectOfModel;
* and take care that you Model has getContentByName() method
-->
@php $self=$page->layout @endphp
<!--   endinclude @content... directives -->
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('layouts.app_head',compact('page'))
</head>
<body>
<div class="container">
    @include('flash::message')
</div>
    <div id="app">
        <!--Start Header-->
        <header class="header">
           @foreach($page->layout->headers as $header)
               @includeIfExist($header->getViewName(), compact('header'))
           @endforeach
           @yield('page_headers')
        </header>
        <!--End Header-->
        @if($breadcrumbs = $page->getBreadCrumbChain())
        <!--Start Breadcrumb-->
        <div class="breadcrumb-container">
            <div class="container flex-clearfix">
                <ol class="breadcrumb">

                    @foreach($breadcrumbs as $item)
                        @if(!is_null($item['href']))
                            <li><a href="{{$item['href']}}">{{$item['name']}}</a></li>
                        @else
                            <li class="active">{{$item['name']}}</li>
                        @endif
                    @endforeach
                </ol>
                <a href="@contentHref('button_join')" class="button btn-blue">@contentHrefText('button_join')</a>
            </div>
        </div>
        <!--End breacrumb-->
        @endif
        @yield('content')
        @yield('page_footers')
        @foreach($page->layout->footers as $footer)
            @includeIfExist($footer->getViewName(), ['footer'=>$footer])
        @endforeach
        {{--@include('footers.app_footer')--}}
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>--}}
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/wow.js"></script>

    <script src="/js/main.js"></script>
    <script src="/js/scroll_down.js"></script>
    <script src="/js/cropper.js"></script>
    <script src="/js/app_js_cropper.js"></script>
{{--aaaaa={{(!Session::get('timezone'))}}--}}
@php
    if(!Session::get('timezone')){
                if( isset($_COOKIE['timezone'])){
                                    Session::put('timezone', $_COOKIE['timezone']);
                }
    }

@endphp
    <script>
        $('#flash-overlay-modal').modal();
    </script>

</body>
</html>
