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
@php $self=$footer @endphp
<!--   endinclude @content... directives -->
<main>
    <!--Start reviews carousel-->
<div class="garmonical-reviews">
    <div class="container">
        <div class="flex-block justify-content-space-beetwen align-items-center xs-flex-column">
            <div class="title white-text xs-text-center wow fadeIn" data-wow-offset="200" data-wow-duration="2s">@contentTitle('reviews_link')</div>
            <a href="@contentHref('reviews_link')" class="button btn-black xs-margin-t wow fadeIn"  data-wow-offset="200" data-wow-duration="2s">@contentHrefText('reviews_link')</a>
        </div>
        <div class="owl-carousel owl-theme flex-height-container carousel-review wow fadeIn"  data-wow-offset="200" data-wow-duration="2s" id="garmonical-review">
            @foreach(App\Review::all() as $review)
                <div class="item">
                    <div class="garmonical-review-description">
                        {!!nl2br(($review->body))!!}
                    </div>
                    <div class="garmonical-review-triangle"></div>
                    <div class="garmonical-review-info">
                        <div class="garmonical-review-name">
                            {{$review->name}}
                        </div>
                        <div class="garmonical-review-profile">{{($review->country)?$review->country->name:''}}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</main>
<!--End reviews carousel-->