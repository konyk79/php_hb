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
<main class="content">
    <div class='container'>
        <div class='row'>
            <div class='col-md-4'></div>
            <div class='col-md-4'>
                @php
                    $route = 'addmoney.stripe';
                    $route = $isSubscription ? $route . '.subscription' : $route;
                @endphp
                <form class='form-horizontal' method='POST' id='payment-form' role='form' action='{!!route($route)!!}' >
                    {{ csrf_field() }}

                    <div class='form-row'>
                        <div class='col-xs-12 form-group card required'>
                            <label class='control-label'>Card Number</label>
                            <input autocomplete='off' class='form-control card-number' size='20' type='text' name='card_no'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-xs-4 form-group cvc required'>
                            <label class='control-label'>CVV</label>
                            <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' name='cvvNumber'>
                        </div>
                        <div class='col-xs-4 form-group expiration required'>
                            <label class='control-label'>Expiration</label>
                            <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' name='ccExpiryMonth'>
                        </div>
                        <div class='col-xs-4 form-group expiration required'>
                            <label class='control-label'>Year</label>
                            <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' name='ccExpiryYear'>
                            <input class='form-control' type='hidden' name='amount' value='{{$total}}'>
                            <input class='form-control' type='hidden' name='userHasSubscribeId' value='{{$userHasSubscribeId}}'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-md-12'>
                            {{--<div class='form-control total'>--}}
                                Total:
                                <span class='amount'>${{$total}}</span>
                            {{--</div>--}}
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-md-12 form-group'>
                            <button class='form-control btn btn-primary submit-button' type='submit'>Pay »</button>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-md-12 error form-group hide'>
                            <div class='alert-danger alert'>
                                Please correct the errors and try again.
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class='col-md-4'></div>
        </div>
    </div>

</main>
<!--End content-->