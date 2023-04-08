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
@php
    $self=$page;
    $user = Auth::user();
@endphp
<!--   endinclude @content... directives --><!--Start content-->
<!--Start content-->
@php
    if (isset($_GET['type'])){
          switch($type=$_GET['type']){
          case 'regular':
              $isRegular=true;
              $isCorporate=false;
              $isPrivate=false;
          break;
          case 'corporate':
              $isRegular=false;
              $isCorporate=true;
              $isPrivate=false;
          break;
          case 'private':
              $isRegular=false;
              $isCorporate=false;
              $isPrivate=true;
          break;
          }
          $type = $_GET['type'];
      }else{
          $type ='regular';
           if ($user->getType()== 'corporate')
              $type ='corporate';
          $isRegular=true;
          $isCorporate=false;
          $isPrivate=false;
      }
@endphp
<main class="content podpiska">
    <div class="container">
        <div class="title text-center">{{$page->title}}</div>
        <div class="title-short-info">
            @contentText('subscribe_text')
        </div>
        <!-- Nav tabs -->
        @if(!($user->hasRole('admin')||$user->hasRole('teacher')))
            <ul class="nav nav-tabs tab-roox">
                @if($user->getType()=='private')
                    <li role="presentation" @if($isRegular)class="active" @endif><a
                                href="{{url('/dashboard/subscribes?type=regular')}}">@contentHrefText('regular_text')</a>
                    </li>
                    <li role="presentation" @if($isPrivate)class="active" @endif><a
                                href="{{url('/dashboard/subscribes?type=private')}}">@contentHrefText('private_text')</a>
                    </li>
                @elseif($user->getType()=='corporate')
                    <li role="presentation" @if($isCorporate)class="active" @endif><a
                                href="{{url('/dashboard/subscribes?type=corporate')}}">@contentHrefText('corporate_text')</a>
                    </li>
                @endif
            </ul>
        @endif
    </div>
    <div class="container-fluid bottom-part">
        <div class="container">
            @if($user->hasRole('admin')||$user->hasRole('teacher'))
                <table class="table-roox">
                    <tr>
                        <th style="width: 30%;">{{trans('subscribe.name')}}</th>
                        <th>{{trans('subscribe.description')}}</th>
                        {{--<th class="hidden-xs"></th>--}}
                    </tr>
                    @foreach($user->getAllowSubscribes() as $subscribe)
                        <tr>
                            <td>{{$subscribe->name}}</td>
                            <td class="desc">{{$subscribe->description}}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                <table class="table-roox">
                    <tr>
                        <th style="width: 30%;">{{trans('subscribe.name')}}</th>
                        <th>{{trans('subscribe.description')}}</th>
                        <th class="hidden-xs"></th>
                    </tr>
                    @foreach($user->getAllowSubscribes($type) as $subscribe)
                        <tr>
                            <td>{{$subscribe->name}}</td>
                            <td class="desc">{!!nl2br(strip_tags($subscribe->description)) !!}</td>
                            <td>
                                @if($us_id=$user->hasUserSubscribeReturnId($subscribe))
                                    {{--{{$us_id}}--}}
                                    <a href="/dashboard/subscribe/{{$us_id}}/terminate" class="button btn-black-border full-width">{{trans('subscribe.delete_subscribe')}}</a>
                                @else
                                    {{--{{is_null($us_id)}}--}}
                                    <a href='{{url("/dashboard/subscribe-order/$subscribe->id")}}' class="button btn-blue full-width">{{trans('subscribe.add_subscription')}}</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
</main>
<!--End content-->