<!--   this view blade template for model App\Page
* you can get access to current obgect of model via
* $page
*$news - has news with pagination
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
    $config=\App\PageHasNews::first();
        $news= App\News::where('visible',true)->paginate($config->paginate);
@endphp

<!--Start content-->
<main class="content">
    <div class="container">
        <!--Start News-->
        <div class="news">
        @foreach ($news as $new)
            <!--News item-->
                <div class="news-item">
                    <div class="news-item-image" style="background-image: url({{$new->image}})"></div>
                    <div class="news-item-text">
                        <div class="title small">{{$new->title}}</div>
                        <div class="description">
                            {!! $new->description !!}
                        </div>
                    </div>
                    <a href="./news/{{$new->id}}" class="button btn-silver full-width">{{$config->more_button_text}}</a>
                </div>
        @endforeach
        </div>
        {{ $news->links('pagination.default') }}
        <!--End pagination-->
    </div>
</main>
<!--End content-->
@if($forms=$page->forms)
    @foreach($forms as $form)
        @includeIfExist($form->getViewName(),['form'=>$form])
    @endforeach
@endif

