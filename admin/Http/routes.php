<?php

use App\News;

$router->get('/information', ['as' => 'admin.information', function (\SleepingOwl\Admin\Contracts\Template\TemplateInterface $template) {

    return $template->view(
	    'Define your information here.',
        'Information'
    );

}]);


$router->get('/subscribes/{id}/copy', 'Admin\Http\Controllers\SubscribeController@copySubscribe' );
$router->get('/lessons/{id}/copy', 'Admin\Http\Controllers\LessonController@copyLesson' );
$router->get('/user_has_subscribes/{id}/unsubscribe', 'Admin\Http\Controllers\SubscribeController@terminateUserSubscribe' );
$router->get('/subscribes/{id}/unsubscribe', 'Admin\Http\Controllers\SubscribeController@terminateAllUserSubscribeForSubscribe' );
$router->get('/user_has_subscribes/{id}/force-unsubscribe', 'Admin\Http\Controllers\SubscribeController@forceTerminateUserSubscribe' );
//$router->post('/news/export.json', ['as' => 'admin.news.export', function (\Illuminate\Http\Request $request) {
//
//    $response = new \Illuminate\Http\JsonResponse([
//		'title' => 'Congratulation! You exported news.',
//		'news' => App\Model\News5::whereIn('id', $request->_id)->get()
//	]);
//
//	return $response;
//
//}]);