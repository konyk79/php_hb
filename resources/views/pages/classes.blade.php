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
<!--   endinclude @content... directives --><!--Start content-->
<!--Start content-->
<main class="content">
    <div class="container">
        <div class="title">{{$page->title}}</div>
        <div class="title-short-info">
          @contentText('classes_text')
        </div>
        <!--Start training-->
        <div class="training">
            <!--trainig items-->
            <div class="training-item">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="training-action">
                            <img src="@contentImage('regular_classes')" class="img-responsive xs-block-center" alt="">
                            <a href="@contentHref('regular_classes')" class="button btn-red full-width">@contentHrefText('regular_classes')</a>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="training-description">
                            <div class="title medium">@contentTitle('regular_classes')</div>
                            @contentText('regular_classes')
                        </div>
                    </div>
                </div>
            </div>
            <!--trainig items-->
            <div class="training-item">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="training-action">
                            <img src="@contentImage('corporate_classes')" class="img-responsive xs-block-center" alt="">
                            <a href="@contentHref('corporate_classes')" class="button btn-red full-width">@contentHrefText('corporate_classes')</a>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <div class="training-description">
                            <div class="title medium">@contentTitle('corporate_classes')</div>
                            @contentText('corporate_classes')
                        </div>
                    </div>
                </div>
            </div>
            <!--trainig items-->
            <div class="training-item">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="training-action">
                            <img src="@contentImage('private_classes')" class="img-responsive xs-block-center" alt="">
                            <a href="@contentHref('private_classes')" class="button btn-red full-width">@contentHrefText('private_classes')</a>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="training-description">
                            <div class="title medium">@contentTitle('private_classes')</div>
                            @contentText('private_classes')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End training-->
    </div>
</main>
<!--End content-->