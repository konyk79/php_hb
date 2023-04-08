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
@php
    $user=Auth::user();
@endphp

<main class="content lc-cabinet">
    <div class="container">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs tab-roox">
            <li role="presentation"><a href="@contentHref('my_subscribes_my_data')">@contentHrefText('my_subscribes_my_data')</a></li>
            <li role="presentation"><a href="@contentHref('my_subscribes_my_classes')">@contentHrefText('my_subscribes_my_classes')</a></li>
            <li role="presentation" class="active"><a href="@contentHref('my_subscribes_my_subscribes')">@contentHrefText('my_subscribes_my_subscribes')</a></li>
        </ul>
    </div>
    <div class="container-fluid lc-content">
        <div class="container">
            <!--Start table-->
{{--            {{$user->getUserSubscribes() }}--}}
            @if(($user->hasRole('admin')||$user->hasRole('teacher')))
                <div class="text-center">{{trans('my_subscribe.message_for_administrators')}}</div>
            @else
            <table class="table-roox">
                <thead>
                <tr>
                    <th>{{trans('my_subscribe.term')}}</th>
                    <th>{{trans('my_subscribe.subscribe')}}</th>
                    <th style="width: 30%;">{{trans('my_subscribe.subscribe_status')}}</th>
                    <th>{{trans('my_subscribe.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->user_subscribes as $userSsubscribe )
                    <tr>
                        <td>
                            <div class="date-start">{{$userSsubscribe->getStartDateAsString()}}</div>
                            <div class="date-end">{{$userSsubscribe->getEndDateAsString()}}</div>
                        </td>
                        <td>
                           {{$userSsubscribe->subscribe->name}}
                            <br>
                            ({{$userSsubscribe->subscribe->type->name}})
                        </td>
                        <td class="{{($userSsubscribe->is_active)?'':'no'}}active">
                            {{($userSsubscribe->is_active)?$userSsubscribe->getStatusName()." (used ".$userSsubscribe->getUsedClasses()." from ".$userSsubscribe->subscribe->num_classes." classes)":$userSsubscribe->getStatusName()}}
                        </td>
                        @if($userSsubscribe->is_active)
                            {{--{{$userSsubscribe->classesHistories()}}--}}
                            {{--{{$userSsubscribe->getUsedClasses()}}--}}
                            <td><a href="/dashboard/subscribe/{{$userSsubscribe->id}}/terminate" class="button btn-black-border full-width">{{trans('my_subscribe.delete_subscribe')}}</a></td>

                        @else
                            <td><a href="/dashboard/subscribe/{{$userSsubscribe->id}}/terminate" class="button btn-black-border full-width">{{trans('my_subscribe.delete_subscribe')}}</a>
                            <a href="/dashboard/subscribe/preview/{{$userSsubscribe->subscribe->id}}" class="button btn-blue full-width">{{trans('my_subscribe.prolongate_subscribe')}}</a></td>
                            {{--<td><a href="/dashboard/subscribe/{{$userSsubscribe->subscribe->id}}/add" class="button btn-blue">Оформить подписку</a></td>--}}
                        @endif
                    </tr>
                @endforeach

                </tbody>
            </table>
            <!--End table-->
            @endif
        </div>
    </div>
</main>
<!--End content-->