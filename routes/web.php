<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/admin', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@getDashboard'])->middleware(['admin']);
Route::get('/admin', 'SleepingOwl\Admin\Http\Controllers\AdminController@getDashboard')->name('admin.dashboard');

Route::get('/confirm/{confirmation_code}', 'Auth\RegisterController@confirmEmail');
//Route::get('/login/facebook', 'Auth\LoginController@redirectToProvider');
//Route::get('/login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/changelanguageto/{language}', 'Controller@changeLanguage')->name('change.language');
Route::post('/news/subscribe/{form}','Controller@newsSubscribe');
Route::post('/contacts/{form}','Controller@contactsMessage');
Route::get('/news/{news}', 'Controller@news')->name('news');

//dashboards
Route::get('/dashboard/order/privet/lessons/teacher/{teacherId}', 'DashboardController@orderPrivetLesson');
Route::get('/dashboard/classes/{lesson}/click', 'ClassesController@click');
Route::get('/dashboard/classes/{lesson}/cancel/click', 'ClassesController@clickCancel');
Route::get('/dashboard/subscribe/{id}/terminate', 'SubscribeController@terminateSubscription');
Route::post('/dashboard/subscribe/preview/{subscribe}', 'SubscribeController@preview');
Route::get('/dashboard/subscribe/back/{id}', 'SubscribeController@back');
Route::get('/dashboard/zoom/test', 'ZoomController@test');
Route::get('/dashboard/zoom/test', 'ZoomController@test');
Route::get('/dashboard/subscribe/preview/{subscribe}', 'SubscribeController@previewExist');
Route::get('/dashboard/subscribe/payment/{id}', 'PaymentController@prepare');
Route::get('/dashboard/subscribe/success', 'SubscribeController@resultSuccess');
Route::get('/dashboard/subscribe/error', 'SubscribeController@resultError');
Route::get('/dashboard/subscribe/{id}/create', 'SubscribeController@createSubscription');
Route::get('/dashboard/subscribe/{id}/prolongate', 'SubscribeController@prolongateSubscription');
Route::get('/dashboard/subscribe-order/{id}', 'SubscribeController@subscribeOrder');
Route::get('/dashboard/my-classes', 'ClassesController@index');
Route::get('/dashboard/schedule/{type}/{schedule_id}/{teacher_id}', 'ScheduleController@show'); //0 - all
Route::get('/dashboard/home', 'HomeController@index')->name('home');
Route::get('/dashboard/users/getImage/{filename}', ['as'=>'image', 'uses'=>'PhotoController@getProfileImage']);
Route::get('/dashboard/users/getImage/{user}/{filename}', ['as'=>'image', 'uses'=>'PhotoController@getUserImage']);
Route::get('/dashboard/users/deleteImage', 'PhotoController@deleteRegistrationImage');
Route::post('/dashboard/profile/{user_id}', 'DashboardController@updateUser');
Route::post('/dashboard/users/uploadImage', 'PhotoController@updateRegistrationImage')->name('dashboard.users.upload.image');
Route::get('/',function(){
    return redirect(route('pages', "main"));
});

/**
 * Payment systems
 */

// Paypal
Route::get('/payment/paypalec/submit/{userHasSubscribeId}', 'PayPalController@getExpressCheckout');
Route::get('paypal/ec-checkout-success',                    'PayPalController@getExpressCheckoutSuccess');
Route::post('/payment/paypal/notify',                       'PayPalWebhookController@notify');
Route::post('payment/notify',                               'PayPalWebhookController@notify');
//Route::get('paypal/adaptive-pay', 'PayPalController@getAdaptivePay');
Route::get('/payment/paypalec/cancel/{profileId}', 'PayPalController@cancelRecurringProfile');

// Stripe
Route::get('dashboard/payment/stripe/{userHasSubscribeId}',      'StripeController@payWithStripe')->name('addmoney.paywithstripe');
Route::post('/payment/stripe',              'StripeController@postPaymentWithStripe')->name('addmoney.stripe');
Route::post('/payment/stripe-subscription', 'StripeController@submitSubscriptionWithStripe')->name('addmoney.stripe.subscription');
Route::post('/payment/stripe/notify',       'StripeWebhookController@notify');
Route::get('/payment/stripe/cancel/{profileId}', 'StripeController@cancelRecurringProfile');





Route::get('/{name}', 'Controller@main')->name('pages');
Route::get('/dashboard/{name}',  'DashboardController@dashboard')->where('name', '([A-z\d-\/_.]+)?')->name('dashboard.pages');
Auth::routes();