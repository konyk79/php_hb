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
<main class="content">
    <div class="container">
        <div class="benefit">
            <img src="@contentImage('benefit_harmonious_breathe')" alt="" class="center-block">
            <div class="title-base">@contentTitle('benefit_harmonious_breathe')</div>
            <div class="title-base line italic black-text no-upp">@contentHrefText('benefit_harmonious_breathe')</div>
            @contentText('benefit_harmonious_breathe')
            <img src="@contentImage('benefit_benefit')" alt="" class="center-block">
            <div class="title-base">@contentTitle('benefit_benefit')</div>
            <div class="title-base line italic black-text no-upp">@contentHrefText('benefit_benefit')</div>
            @contentText('benefit_benefit')
            <img src="@contentImage('benefit_faqs')" class="center-block" alt="">
            <div class="title-base">@contentTitle('benefit_faqs')</div>
            @php($faqs= \App\Faq::all())
            @if($faqs)
                @foreach($faqs as $faq)
                    <div class="title-base line italic black-text no-upp">{{$faq->question}}</div>
                    <p>{!! nl2br($faq->answer)!!}</p>
                @endforeach
            @endif
        </div>
    </div>
</main>
<!--End content-->