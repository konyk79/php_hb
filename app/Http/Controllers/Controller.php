<?php

namespace App\Http\Controllers;

use App\Form;
use App\News;
use App\Page;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Snowfire\Beautymail\Beautymail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function main($name, $params = null) {
        $page = Page::getByName($name);

        if($page === null) {
            return abort(404, 'main controller');
        }

        $parameters = ['page' => $page];

        if($params !== null){
            $parameters = array_merge($parameters, $params);
        }
//        dd($parameters);
        return View::make('app')->with($parameters);
    }


    public function news(News $news)
    {
        $page = Page::getByName('one_news');
        if (is_null($page) || is_null($news)) return abort(404);
        return view('app')->with(['page'=>$page, 'news'=> $news]);
    }
    public function contactsMessage(Request $request, Form $form)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required',
            'subject' => 'required',
            'body' => 'required|string',
        ]);
        try {
            $beautymail = app()->make(Beautymail::class);
            $beautymail->send('email.beautymail_contactform', [
                'email' => $request->email,
                'subject' => $request->subject,
                'name' => $request->name,
                'body' => $request->body
            ], function($message) {
                $message
                    ->from('no-replay@harmoniousbreathing.com')
                    ->to('konyk@inbox.ru','For developer')
                    ->to('tigran@harmoniousbreathing.com', 'Harmonious Breathing Office')
                    ->subject('HB - Вопрос со страницы контакты');
            });
//            flash( trans('mail.your_message_sent_successfully'),'success');
            return back()->with(['error'=>$error=0, 'anchor'=> true]);          // ->with('result', 'ok');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
//            flash(trans('mail.your_message_did_not_send'),'danger');
            return back()->with(['error'=>$error=$e->getMessage(), 'anchor'=> true]);          //->with('result', 'fault');
        }
    }
    public function newsSubscribe(Request $request, Form $form)
    {
        $data=$request->all();
//        dd($form);
        $fields=$form->fields;
        if ($fields!= null){
            $model=$form->model;
            $tableName = (new $model())->getTable();
//            dd($tableName);
            $forInsert = array();
            $forInsert['created_at'] =new \DateTime();
//            $forInsert['created_at'] =new \DateTime();
            foreach($fields as $field){
                $forInsert[$field->name]=  $data[$field->name];
            }
            $error=0;
            try{
                DB::table($tableName)->insert(
                    $forInsert );
            }
            catch(\Illuminate\Database\QueryException $ex){
                Log::error($ex->getMessage());
                $error=$ex->getCode();
                // Note any method of class PDOException can be called on $ex.
            }



        }

        return back()->with(['error'=>$error, 'anchor'=> true]);
    }




    public static function changeLanguage($language) {

        session()->put('locale', $language);
        app()->setLocale(session('$language'));
        if (strpos($language, '_') !== false){
            list($language,$other)=explode('_',$language);
        }
        //for admin panel menu
        setcookie ( 'locale_php', $language,time()+3600*24*30, '/');
//        dd( session()->get('locale'));
        // Updating default language for user
//        $user = Auth::user();
//        if($user !== null) {
//            $user->language = $language;
//            $user->save();
//        }

        return back();
    }

}
