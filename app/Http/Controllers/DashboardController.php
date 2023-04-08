<?php

namespace App\Http\Controllers;

use App\Form;
use App\Subscribe;
use App\Teacher;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use SleepingOwl\Admin\Http\Controllers\AdminController;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function orderPrivetLesson($teacherId){
        if ((! ($user=Auth::user())) || !(
            $user->getMainRoleCode() == 'subscriber'
           ||  $user->getMainRoleCode() == 'user' )
        ){
            flash(trans('flash_messages.user_cant_do_this'))->warning()->important();
            return back();
        }
        if (!$teacher=Teacher::find($teacherId) )  {
            flash(trans('flash_messages.no_such_teacher'))->warning()->important();
            return back();
        }
//        dd($user->getType());
        if($user->getType()!='private') {
            flash(trans('flash_messages.user_cant_do_this'))->warning()->important();
            return back();
        }else{
//            dd($teacher->private_lessons->count());
            if ($teacher->private_lessons->count()>0){
                return redirect(url('http://hb.local/dashboard/schedule/private/0/'.$teacher->id));
            }else{
                flash(trans('flash_messages.teacher_has_no_privet_lessons'))->warning()->important();
                return back();
            }

        }

    }

    public function getDashboard()
    {
//        dd(Auth::user());
        if(is_null(Auth::user())) return abort(404);
        $isSuperAdmin =Auth::user()->isSuperAdmin();
        if ($isSuperAdmin){
//            return parent::getDashboard();
            return app('SleepingOwl\Admin\Http\Controllers\AdminController')->getDashboard();
        }else{
//            flash('YOU HAVENT PERMISSION')->important()->error();
            return abort(404);
        }

    }
    public function dashboard($name)
    {
        return  $this->main('dashboard/'.$name);
    }

    public function updateUser(Request $request, $user_id)
    {
        $this->validate($request, [
            'password' => 'confirmed',
            'country_id' => 'numeric',
        ]);
//        dd($request->all());
        $data = $request->all();
        $form=Form::where('name', 'profile_form')->first();
        $dataUser =array( );
        $dataUser['updated_at']=Carbon::now();
        foreach ($form->fields as $field){
            if (($field->type !== 'none') && array_key_exists($field->name,$data )){
                if ($field->element == 'password' ) {
                    if ($data[$field->name] !== null)
                        $dataUser[$field->name] = bcrypt($data[$field->name]);
                }
                else
                    $dataUser[$field->name] = $data[$field->name];
            }

        }
//        dd($dataUser);
        DB::table('users')->where('id', $user_id)->update($dataUser);
        return back();
    }
}
