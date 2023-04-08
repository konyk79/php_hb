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
<!--   endinclude @content... directives -->

<!--Start content-->
<main class="content lc-cabinet">
    <div class="container">
        <div class="title text-center mar-bot">{{trans('subscription_order.preview_title')}}</div>
        <div class="row flex-block flex-height-container flex-clearfix">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('subscription_order.chosen_subscription')}}</div>
                    <div class="panel-body">
                        {{$userSubscribe->subscribe->name}}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('subscription_order.chosen_payment_system')}}</div>
                    <div class="panel-body">
                        {{$userSubscribe->payment_system->name}}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('subscription_order.number_lessons')}}</div>
                    <div class="panel-body">
                        {{$userSubscribe->subscribe->num_classes}}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('subscription_order.is_autoprolongate')}}</div>
                    <div class="panel-body">
                        @if($userSubscribe->subscribe->is_auto_prolangate)
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox" checked readonly="readonly" disabled>
                                <label for="checkbox1"></label>
                            </div>
                        @else
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox" readonly="readonly" disabled>
                                <label for="checkbox1"></label>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('subscription_order.promo_code')}}</div>
                    <div class="panel-body">
                        {{($userSubscribe->promo)?$userSubscribe->promo->name:''}}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('subscription_order.price')}}</div>
                    <div class="panel-body">
                        @php

                            if($userSubscribe->subscribe->price>$userSubscribe->price){
//                               $price= $subscribe->price*(1+$subscribe->discount->discount);
                               // dd($subscribe->discount->discoun);
                                $isDiscount=true;
                            }else{
                                $isDiscount=false;
//                              $price= $subscribe->price;
                            }
                        @endphp
                       @if( $isDiscount) <span class="old-price">{{trans('subscription_order.old_price')}} - {{$userSubscribe->subscribe->price}} $</span>
                        <div>{{trans('subscription_order.new_price')}} - {{$userSubscribe->price}} $</div>
                       @else
                            {{$userSubscribe->price}}
                       @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('subscription_order.term')}}</div>
                    <div class="panel-body">
                        {{$userSubscribe->subscribe->term_text}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mar-bot">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="{{url('/dashboard/subscribe/back/'.$userSubscribe->id)}}" class="button btn-black-border">{{trans('subscription_order.button_cancel')}}</a>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <a href="{{url('/dashboard/subscribe/payment/'.$userSubscribe->id)}}" class="button btn-blue">
                    @if(isset($continue) && $continue==true)
                        {{trans('subscription_order.button_prolongate')}}
                    @else
                        {{trans('subscription_order.button_pay')}}
                    @endif
                </a>
            </div>
        </div>
    </div>
</main>
<!--End content-->