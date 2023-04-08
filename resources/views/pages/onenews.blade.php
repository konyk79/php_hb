<!--Start content-->
<main class="content">
    <div class="container">
        <div class="news-open">
            <img src="{{$news->image}}" alt="" class="center-block">
            <div class="title-base">{{$news->title}}</div>
            <p>{!! nl2br(($news->body)) !!}</p>
        </div>
    </div>
</main>
<!--End content-->