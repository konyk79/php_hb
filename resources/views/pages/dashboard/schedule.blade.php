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
<main class="content lc-cabinet">
    <div class="container">
        @if($type =='regular')
            <div class="title medium text-center sm-margin-b mar-bot">@contentTitle('regular_classes_schedule_title')</div>
        @endif
        @if($type =='corporate')
            <div class="title medium text-center sm-margin-b mar-bot">@contentTitle('corporate_classes_schedule_title')</div>
        @endif
        @if($type =='private')
                <div class="title medium text-center sm-margin-b mar-bot">@contentTitle('private_classes_schedule_title')</div>
        @endif

        <!-- Nav tabs -->
        {{--<ul class="nav nav-tabs tab-roox">--}}
            {{--<li role="presentation"><a href="#">Все занятия</a></li>--}}
            {{--<li role="presentation" class="active"><a href="#">Преподаватель</a></li>--}}
        {{--</ul>--}}
        <!--Start Time-Zone-->
        <div class="row mar-bot">
            <div class="col-lg-offset-2 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <p>@contentTitle('choose-schedule')</p>
                <div class="custom-select-box">
                    <div class="triangle"></div>
                    <select name="select-schedule" id="select-schedule" class="form-control">
{{--                        {{dd(App\Schedule::getSelectOptions($schedule_id))}}--}}
                        @foreach (App\Schedule::getSelectOptions($schedule_id) as $val=> $item)
                            <option {{ $item['selected'] }} value="{{$val}}">{{$item['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 xs-margin-t">
                <p>@contentTitle('choose-teacher')</p>
                <div class="custom-select-box">
                    <div class="triangle"></div>
                    <select name="select-teacher" id="select-teacher" class="form-control">
{{--                        {{dd(App\Schedule::getSelectOptions($teacher_id))}}--}}
                        @foreach (App\Teacher::getSelectOptions($teacher_id) as $val=> $item)
                            <option {{ $item['selected'] }} value="{{$val}}">{{$item['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="title title-base text-center mar-bot">
           @contentText('warning_timezone')
        </div>
        <!--End Time Zone-->
    </div>
{{--    {{dd($schedule)}}--}}
    <div class="container-fluid lc-content">
        <div class="container">
            <!--Start table-->
            <table class="table-roox time-table">
                <thead>
                <tr>
                    <th></th>
                    <th>{{trans('schedule.Mon')}}</th>
                    <th>{{trans('schedule.Thu')}}</th>
                    <th>{{trans('schedule.Wed')}}</th>
                    <th>{{trans('schedule.Thu')}}</th>
                    <th>{{trans('schedule.Fri')}}</th>
                    <th>{{trans('schedule.Sat')}}</th>
                    <th>{{trans('schedule.Sun')}}</th>
                </tr>
                </thead>
                <tbody>
                @if($schedule)
                    @foreach($schedule as $time => $data)
                <tr>

                        <td class="times">{{$time}}</td>
                        @foreach($data as $day => $lessons)
                            <td class="records">

                                <div class="day-name">{{$day}}</div>
                                @if(!is_null($lessons))
                                @foreach($lessons as $lesson)
                                    <div class="records-item" style="background-color: {{$lesson->color}};">
                                        @if($lesson->isCancelButton())
                                        <button onclick='window.location.href = "{{url('/dashboard/classes/'.$lesson->id.'/cancel/click')}}"'
                                                class="close"  aria-label="Close"><span  aria-hidden="true">×</span>
                                        </button>
                                        @endif
                                        <a href ="{{url('/dashboard/classes/'.$lesson->id.'/click')}}">
                                            <div class="teacher-name">{{$lesson->teacher->user->name}}</div>
                                            <div class="record-name">{{$lesson->name}}<span class="text-detail-small">({{$lesson->getStatus()}})</span></div>
                                            <div class="record-time">{{$lesson->term_text}}</div>
                                        </a>
                                    </div>

                                @endforeach
                                @endif

                            </td>
                        @endforeach

                </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <!--End table-->
            <p>
                @contentText('after_schedule_text')
            </p>
        </div>
    </div>
</main>
<!--End content-->