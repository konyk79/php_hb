<!--   this view blade template for model App\Page
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

<div class="header-navigation header-main-page"
     style="background-image: url( @contentImage('main_header') )" >
    @if($header->menu)
        @includeIfExist($header->menu->getViewName(),['menu'=>$header->menu ])
    @endif
    @php

    @endphp
    <div class="row nom">
        <div class="col-xs-12 visible-xs"> <img src=" @contentImage('main_header_mobile_img') " class="img-responsive center-block" alt=""></div>
        <div class="col-md-offset-7 col-md-5 col-sm-offset-7 col-sm-5 col-xs-12 write-on-lessons">
            <!-- Что нужно добавить!!!-->
            <div id="homeCarousel" class="carousel slide roox-carousel" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    @foreach(\App\Slider::all() as $key=>$slide)
                        <div class="item @if($key==0) active @endif">
                            <div class="title">{{$slide->title}}</div>
                            <div class="description">
                               {{$slide->text}}
                            </div>
                            <a href="{{$slide->href}}" class="button btn-blue">{{$slide->href_text}}</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--/-->
        </div>
    </div>
</div>