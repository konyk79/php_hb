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
        <div class="title-silver-line">@contentTitle('team_main_text')</div>
        <div class="title-short-info">
            @contentText('team_main_text')
        </div>

        <!--Start team-->
        <div class="team">
            @foreach(App\Teacher::all() as $teacher)
                @php
                    $photo = $teacher->user->photo;
                    $filename = 'default-user-image.png/';
                    if(!is_null($photo)) {
                        $filename = $teacher->user->photo . "/";
                    }
                @endphp
                <!--team items-->
                    <div class="team-item">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="team-picture xs-margin-b">
                                    <img src="{{url('/dashboard/users/getImage/'.$teacher->user->id.'/'.$filename)}}" class="img-responsive xs-block-center" alt="team">
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div class="team-header xs-flex-column">
                                    <div class="team-name">
                                        {{$teacher->user->name}}
                                        <span class="team-country">{{$teacher->user->country->name}}</span>
                                    </div>
                                    <a href="/dashboard/order/privet/lessons/teacher/{{$teacher->id}}" class="button btn-blue-border">Заказать частный урок</a>
                                </div>
                                <div class="team-body">
                                    {{$teacher->user->about_me}}
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach


        </div>
        <!--End team-->
    </div>
</main>
<!--End content-->