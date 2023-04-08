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
        <div class="title medium text-center">{{$subscribe->name}}</div>
        <!--Start pay box-->
        <form method="POST" action='{{ "/dashboard/subscribe/preview/$subscribe->id"}}'>
            {{ csrf_field() }}
        <div class="subscribe-pay xs-flex-column">
            <div class="subscribe-pay-description xs-width-auto xs-text-center">
             {{$subscribe->description}}
            </div>
            <div class="subscribe-pay-info text-center xs-width-auto">
                <div class="subscribe-pay-info-section">
                    {{trans('subscription_order.term')}}
                    <div class="subscribe-pay-info-value">{{$subscribe->term_text}}</div>
                </div>
                <hr>
                <div class="subscribe-pay-info-section">
                    {{trans('subscription_order.price')}}, $
                    @php

                            if($subscribe->discount){
                                $price= Helpers::formatFloat($subscribe->price*(1+$subscribe->discount->discount));
                               // dd($subscribe->discount->discoun);
                                $isDiscount=true;
                            }else{
                                $isDiscount=false;
                                $price= $subscribe->price;
                            }
                    @endphp
                    <div class="subscribe-pay-info-value">
                        @if($isDiscount) <span class="old-price"> {{$subscribe->price}}</span> @endif {{$price}}
                    </div>
                    <input type="text" name="promo_code"   name="promo_id" class="form-control" placeholder="{{trans('subscription_order.promo_code')}}">
                    <div class="text-detail-small">{{trans('subscription_order.promo_text')}}</div>
                </div>
                <hr>
                <div class="subscribe-pay-info-section">
                    {{trans('subscription_order.payment_methods')}}
                    <div class="custom-select-box">
                        <div class="triangle"></div>
                        <select name="payment_system_id" id="payment_system_id" class="selectpicker form-control" required>
                            @foreach(\App\PaymentSystem::all() as $paymentsystem)
                            <option value="{{$paymentsystem->id}}">{{$paymentsystem->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!--End pay box-->
        <!--Start pay action-->
        <div class="subscribe-pay-action xs-flex-column">
            <div class="subscribe-pay-info-method xs-width-auto">
                <img src="img/icons/puymethod.png" class="img-responsive center-block" alt="">
            </div>
            <div class="subscribe-pay-button xs-margin-t xs-width-auto">
                <button type="submit"  class="button btn-red full-width">{{trans('subscription_order.next_button_text')}}</button>
            </div>
        </div>
        </form>
        <!--End pay action-->
    </div>
</main>
<!--End content-->