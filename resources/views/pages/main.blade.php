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
@php $self=$page @endphp
<!--   endinclude @content... directives -->
<!--Start content-->
<main>
    <!--Start Garmonical carousel-->
    <div class="garmonical-bright wow fadeIn" data-wow-offset="200" data-wow-duration="2s">
        <div class="container">
            <div class="title">{{$self->title}}</div>
            <div class="owl-carousel owl-theme garmonical-carousel flex-height-container" id="garmonical-carousel">
                <div class="item">
                    <div class="picture">
                        <img src="@contentImage('main_page_benefits')" class="img-responsive" alt="">
                    </div>
                    <div class="description">
                        <div class="title medium">@contentTitle('main_page_benefits')</div>
                        @contentText('main_page_benefits')
                    </div>
                    <a href="@contentHref('main_page_benefits')" class="button btn-silver full-width">
                        @contentHrefText('main_page_benefits')</a>
                </div>
                <div class="item">
                    <div class="picture">
                        <img src="@contentImage('main_page_team')" class="img-responsive" alt="">
                    </div>
                    <div class="description">
                        <div class="title medium">@contentTitle('main_page_team')</div>
                        @contentText('main_page_team')
                    </div>
                    <a href="@contentHref('main_page_team')" class="button btn-silver full-width">
                        @contentHrefText('main_page_team')
                    </a>
                </div>
                <div class="item">
                    <div class="picture">
                        <img src="@contentImage('main_page_offers')" class="img-responsive" alt="">
                    </div>
                    <div class="description">
                        <div class="title medium">@contentTitle('main_page_offers')</div>
                        @contentText('main_page_offers')
                    </div>
                    <a href="@contentHref('main_page_offers')" class="button btn-silver full-width">
                        @contentHrefText('main_page_offers')
                    </a>
                </div>
                <div class="item">
                    <div class="picture">
                        <img src="@contentImage('main_page_custom')" class="img-responsive" alt="">
                    </div>
                    <div class="description">
                        <div class="title medium">@contentTitle('main_page_custom')</div>
                        @contentText('main_page_custom')
                    </div>
                    <a href="@contentHref('main_page_custom')" class="button btn-silver full-width">
                        @contentHrefText('main_page_custom')
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--End garmonical carousel-->
    <!--Start garmonical video-->
    <div class="garmonical-video">
        <div class="container">
            <div class="row flex-block flex-height-container">
                <div class="col-md-7 col-sm-12 video-iframe wow fadeIn" data-wow-offset="200" data-wow-duration="2s">
                    <video id="harmonious-video" poster="@contentImage('main_video_block')" preload="none" controls="controls">
                        <source src="@contentVideo('main_video_block')" type="video/mp4">
                        <img src="" title="@contentHrefTitle('main_video_block')" alt="video">
                    </video>
                </div>
                <div class="col-md-5 col-sm-12 video-description sm-margin-t wow fadeIn" data-wow-offset="200" data-wow-duration="2s">
                    <div class="title">@contentTitle('main_video_block')</div>
                    @contentText('main_video_block')
                </div>
            </div>
        </div>
    </div>
    <!--End garmonical video-->
    {{--@php--}}
        {{--$sliderTimeout = \App\MainConfig::first()->getSliderTimeoutSec();--}}
    {{--@endphp--}}
    <script>
        var sliderTimeout= "{{\App\MainConfig::first()->getSliderTimeoutSec()}}"*1000;
//        console.log(sliderTimeout);
    </script>
</main>
<!--End content-->
