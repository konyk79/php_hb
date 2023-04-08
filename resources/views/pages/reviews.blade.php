<!--   this view blade template for model App\Page
* you can get access to current obgect of model via
* $page
*$reviews - has reviews with pagination
-->
<!--   start include @content... directives
* $self  - must point to model of this html view's entity to make possible use @content... directives
* to include insert such php string
*  $self= $objectOfModel;
* and take care that you Model has getContentByName() method or inherited from ContentableModel::class
-->
@php $self=$page @endphp
<!--   endinclude @content... directives -->
@php
    $reviews= App\Review::paginate(\App\PageHasReviews::first()->paginate);
@endphp
<!--Start content-->
<main class="content">
    <div class="container">
        <!--Start reviews-->
        <div class="row flex-block flex-height-container reviews">
            @foreach($reviews as $review)
            <!--Reviews item-->
            <div class="col-md-6">
                <div class="reviews-item">
                    <div class="review-header">
                        <div class="avatar" style="background-image: url({{$review->image}});">
                            <!--<img src="img/avatar.png" alt="">-->
                        </div>
                        <div class="review-text">
                            {!!nl2br(($review->body))!!}
                        </div>
                    </div>
                    <div class="review-footer">
                        <div class="quote">
                            <img src="img/icons/right-quote-sign.png" alt="quote">
                        </div>
                        <div class="review-person">
                            <div class="name">{{$review->name}}</div>
                            <div class="loacation">{{$review->country->name}}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!--End reviews-->
        {{ $reviews->links('pagination.default')}}
    </div>
</main>
<!--End content-->
