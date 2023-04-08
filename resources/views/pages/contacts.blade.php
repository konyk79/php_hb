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
<main class="content">
    <div class="container contacts">
        <div class="row">
            <!--Start left side-->
            <div class="col-lg-5 col-md-6 col-sm-5 col-xs-12">
                <img src="@contentImage('contacts_image')" class="img-responsive xs-block-center" alt="">
            </div>
            <!--End left side-->
            <!--Start right side-->
            <div class="col-lg-offset-1 col-lg-6 col-md-6 col-sm-7 col-xs-12 xs-margin-t">
                @if($forms=$page->forms)
                    @foreach($forms as $form)
                        @includeIfExist($form->getViewName(),['form'=>$form])
                    @endforeach
                @endif
            </div>
            <!--End right side-->
        </div>
    </div>
</main>
<!--End content-->
