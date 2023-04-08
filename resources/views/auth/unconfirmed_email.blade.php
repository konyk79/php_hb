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


<!--Start content-->
<main class="content">
    <div class="container">
        <div class="title">@contentTitle('unconfirmed_mail')</div>
        <div class="title-short-info">
            @contentText('unconfirmed_mail')
        </div>
        <div class="text-right">
            <a href="@contentHref('unconfirmed_mail')" class="button btn-red mar-top">@contentHrefText('unconfirmed_mail')</a>
        </div>
    </div>
</main>
<!--End content-->