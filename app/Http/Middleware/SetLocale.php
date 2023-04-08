<?php

namespace App\Http\Middleware;

use App\Http\Controllers\HomeController;
use App\Language;
use Closure;
use Illuminate\Support\Facades\Auth;

class SetLocale {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
//        $user = Auth::user();
//        config(['translatable.locales.3'=> 'ua']);

//        if($user === null){
        if($langs=Language::all()){
            foreach ($langs as $key => $lang){
//                print_r($key);
                config(['translatable.locales.'.$key=> $lang->code]);
            }
//            dd(config('translatable'));
        }

            if (session()->has('locale')) {
                $locale = session('locale');
                $request->session()->put('locale', $locale);
//                switch ($locale) {
//                    case 'en':
////                    case 'ua':
//                    case 'ru':
//                    $request->session()->put('locale', $locale);
//                        break;
//                    default:
//                        $request->session()->put('locale', 'ru');
//                        break;
//                }
            } else {
                $code = $request->getPreferredLanguage();
                if (strpos($code, '_') !== false){
                    list($code,$other)=explode('_',$code);
                }
                $request->session()->put('locale', $code );
            }

            app()->setLocale(session('locale'));
            //for admin panel menu
            setcookie ( 'locale_php', session('locale'),time()+3600*24*30, '/');
//            dd(app()->getLocale());
            return $next($request);
//        }
//
//        $request->session()->put('locale', $user->language);
//        app()->setLocale($user->language);
//
//        return $next($request);
    }
}
