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

<main class="content lc-cabinet">
    <div class="container">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs tab-roox">
            <li role="presentation"><a href="@contentHref('my_classes_my_data')">@contentHrefText('my_classes_my_data')</a></li>
            <li role="presentation" class="active"><a href="@contentHref('my_classes_my_classes')">@contentHrefText('my_classes_my_classes')</a></li>
            <li role="presentation"><a href="@contentHref('my_classes_my_subscribes')">@contentHrefText('my_classes_my_subscribes')</a></li>
        </ul>
    </div>
    <!--start calendar-->
    <div class="container-fluid lc-content">
        <div class="container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs tab-roox" >
                @if(($user->hasRole('admin')||$user->hasRole('teacher')))
                <li @if($isRegular)class="active" @endif><a href="@contentHref('my_classes_regular_classes')" >
                        @contentHrefText('my_classes_regular_classes')</a></li>
                <li @if($isPrivate)class="active" @endif><a href="@contentHref('my_classes_private_classes')" >
                        @contentHrefText('my_classes_private_classes')</a></li>
                <li @if($isCorporate)class="active" @endif><a href="@contentHref('my_classes_corporate_classes')">
                        @contentHrefText('my_classes_corporate_classes')</a></li>
                @else
                    @if($user->type->code=='private')
                       <li @if($isRegular)class="active" @endif><a href="@contentHref('my_classes_regular_classes')" >
                               @contentHrefText('my_classes_regular_classes')</a></li>
                       <li @if($isPrivate)class="active" @endif><a href="@contentHref('my_classes_private_classes')" >
                               @contentHrefText('my_classes_private_classes')</a></li>
                    @elseif($user->type->code=='corporate')
                       <li @if($isCorporate)class="active" @endif><a href="@contentHref('my_classes_corporate_classes')">
                               @contentHrefText('my_classes_corporate_classes')</a></li>
                    @endif
                @endif
</ul>
<!-- Tab panes -->
<div class="tab-content">

       {!! $calendar->calendar() !!}
    @php
    if(isset($_COOKIE['screen']))
            $width=$_COOKIE['screen'];
     else $width = 500;

             $options=$calendar->getOptions();
           if(isset($_COOKIE['lastView'])){
             $lastView=$_COOKIE['lastView'];
                $options += ['defaultView' => $lastView];
                $calendar->setOptions( $options);
            }
           if(isset($_COOKIE['lastDayView'])){
             $lastDayView=$_COOKIE['lastDayView'];
                $options += ['defaultDate' => $lastDayView];
                $calendar->setOptions( $options);
            }



//            dump($width);
    if ($width<=600){
    $calendarView = 'agendaDay';

   $options += ['defaultView' => $calendarView];

   $calendar->setOptions( $options);
    }else{
    //$calendarView = null;
    }
    @endphp
{{--    lD={{$lastDayView}}--}}
       {!! $calendar->script() !!}
</div>
</div>
</div>
<!--end calendar-->
</main>
<!--End content-->