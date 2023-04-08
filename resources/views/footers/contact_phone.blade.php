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
<!--   endinclude @content... directives -->
<!--Start contact us-->
<div class="footer-contact">
    <div class="container text-center">
        <div class="title white-text medium">
            @contentTitle('contact_phone_text')
        </div>
        <hr>
        <div class="title white-text"> @contentText('contact_phone_text')</div>
    </div>
</div>
<!--End contacnt us-->