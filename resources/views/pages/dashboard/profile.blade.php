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
<main class="content lc-cabinet">
    <div class="container">
        <!-- Nav menu -->
        <ul class="nav nav-tabs tab-roox">
            <li role="presentation" class="active"><a href="@contentHref('profile_my_data')">@contentHrefText('profile_my_data')</a></li>
            <li role="presentation"><a href="@contentHref('profile_my_classes')">@contentHrefText('profile_my_classes')</a></li>
            <li role="presentation"><a href="@contentHref('profile_my_subscribes')">@contentHrefText('profile_my_subscribes')</a></li>
        </ul>
    </div>
    <div class="container-fluid lc-content">
        <div class="container">
            <!--Start form data-->
            @if($forms=$page->forms)
                @foreach($forms as $form)
                    @includeIfExist($form->getViewName(),['form'=>$form])
                @endforeach
            @endif
            <!--End form data-->
        </div>
    </div>
</main>
<!--End content-->