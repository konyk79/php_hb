<!--   this view blade template for model App\Footer
* you can get access to current obgect of model via
* $footer
-->
<!--   start include @content... directives
* $self  - must point to model of this html view's entity to make possible use @content... directives
* to include insert such php string
*  $self= $objectOfModel;
* and take care that you Model has getContentByName() method
-->
@php $self=$footer @endphp
<!--   endinclude @content... directives --><!--Start contact us-->
<div class="footer-contact-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-1 col-lg-10 col-md-12 flex-block justify-content-center align-items-center xs-flex-column">
                <div class="title white-text xs-text-center medium">@contentTitle('contact_us')</div>
                <a href="@contentHref('contact_us')" class="button btn-black">@contentHrefText('contact_us')</a>
            </div>
        </div>
    </div>
</div>
<!--End contact us-->
