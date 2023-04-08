<?php

namespace Admin\Http\Sections;
use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormButton;
use AdminFormElement;
use App\ClassLevel;
use App\ClassStatus;
use App\Content;
use App\ContentTranslation;
use App\Footer;
use App\Group;
use App\Language;
use App\Schedule;
use App\Subscribe;
use App\Layout;
use App\PageTranslation;
use App\Teacher;
use App\Type;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
//use Admin\Form\Element\TranslatableText;
use Admin\Form\Element\TranslatableText;
use SleepingOwl\Admin\Section;

/**
 * Class Lessons
 *
 * @property \Subscribe $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Lessons extends Section
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
//    protected $title = 'Lessons';
    /**
     * @var string
     */
    protected $alias;

    public function onDisplay()
    {
        $display=AdminDisplay::datatables();
        $display->setView('admin::default.display.table');
        $link = new \SleepingOwl\Admin\Display\ControlLink(function (\Illuminate\Database\Eloquent\Model $model) {
            return '/admin/'.$model->getTable().'/'.$model->getKey().'/copy'; // Генерация ссылки
        }, trans('admin.copy'), 1000);
        $control = $display->getColumns()->getControlColumn();
        $link->setIcon('fa fa-clone')->hideText();
        $control->addButton($link);
        return  $display
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('20px'),
                AdminColumn::text('id', trans('admin.name'))->setName('name')->setWidth('50px'),
                AdminColumn::text( 'type.id' , trans('admin.type'))->setName('type.name')->setWidth('50px'),
                AdminColumn::text( 'status.id' , trans('admin.status'))->setName('status.name')->setWidth('50px'),
                AdminColumn::text( 'teacher.id' , trans('admin.lessons.teacher'))->setName('teacher.user.name')->setWidth('50px'),
                AdminColumn::text( 'schedule.id' , trans('admin.lessons.schedule'))->setName('schedule.name')->setWidth('50px'),
//                AdminColumn::text('discount.id', trans('admin.subscriptions.discount'))->setName('discount.name')->setWidth('80px'),
//                AdminColumn::custom(trans('admin.visible'), function(\Illuminate\Database\Eloquent\Model $model) {
//                    return ($model->visible)?trans('admin.show'):trans('admin.hide');})->setWidth('40px'),
                AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
                ->setLabel(trans('admin.visible'))->setWidth('40px'),
                AdminColumn::custom( trans('admin.term'), function(\Illuminate\Database\Eloquent\Model $model) {
                    $amount = substr($model->term, 0, -1);
                    $period = substr($model->term, -1);
                    $periodString='undefined';
                    switch($period){
                        case 'H':
                            $periodString = trans('admin.hours');
                            break;
                        case 'M':
                            $periodString = trans('admin.minutes');
                            break;
                        case 'S':
                            $periodString = trans('admin.seconds');
                            break;
                    }
                    return $amount.' '.$periodString;
                })->setWidth('60px'),
                AdminColumn::datetime('start_time', trans('admin.lessons.start_time'))->setWidth('40px')
                ->setFormat('d.m.Y'),
                AdminColumn::text('id', trans('admin.subscriptions.description'))->setName('description')->setWidth('300px'),
//                AdminColumn::lists('groups.code', trans('admin.groups'))->setWidth('100px'),
//                AdminColumn::custom( trans('admin.subscriptions.promos'),  function(\Illuminate\Database\Eloquent\Model $model) {
//                    $result ='';
//                    foreach($model->promosName() as $key=>$value){
//                        $result .= '<span class="label label-info">'.$value.'</span> ';
//                    }
////                    dd($result);
//                    return $result;
//
//                })->setWidth('60px'),




            ])
            ->setView('admin::default.display.table');

    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $panel=AdminForm::panel();
        //$panel->getParameters();
        //var_dump($panel);
        $name = array();
//        dd(get_defined_vars()) ;
        foreach (Language::all() as $language){
//            dump($language);
            $name[]= AdminFormElement::text('name:'.$language->code, 'Name'.'('.$language->name.')')->required();
        }
        $panel->getButtons()->replaceButtons([
            'delete' => null, // Убираем кнопку Delete
            'save'   =>  AdminFormButton::save(),
        ]);
        return $panel->addBody([
//            AdminFormElement::text('code', 'Code')->setReadonly(true),
            AdminFormElement::select('type_id', trans('admin.type'),Type::class)->required()
                ->setDisplay('name')
                ,
            AdminFormElement::select('class_status_id', trans('admin.status'),ClassStatus::class)->required()
                    ->setDisplay('name'),
            AdminFormElement::select('teacher_id', trans('admin.lessons.teacher'),Teacher::class)->required()
                    ->setDisplay('user.name'),
            AdminFormElement::select('schedule_id', trans('admin.lessons.schedule'),Schedule::class)->required()
                    ->setDisplay('name'),
                AdminFormElement::select('class_level_id', trans('admin.lessons.level'),ClassLevel::class)->required()
                    ->setDisplay('name'),
                AdminFormElement::select('language_id', trans('admin.lessons.language'),Language::class)->required()
                    ->setDisplay('name'),

            AdminFormElement::checkbox('visible', trans('admin.visible')),
//            AdminFormElement::checkbox('is_active', trans('admin.subscriptions.is_active')),
            AdminFormElement::translatabletext('name',trans('admin.name'))->required(),
            AdminFormElement::text('term',trans('admin.lessons.term') )
                    ->required()->addValidationRule('regex:/^[1]{0,1}[0-9]{2}[M]{1}$/u'),
            AdminFormElement::translatabletext('term_text',trans('admin.subscriptions.term_text'))->required(),
     //       AdminFormElement::select('visible', trans('admin.visible') , ['false' , 'true'])->setDisplay('visible'),

            AdminFormElement::translatabletextarea('description',trans('admin.subscriptions.description'))->required(),
            AdminFormElement::datetime('start_time', trans('admin.lessons.start_time'))->setFormat('Y-m-d H:i:s')
                ->required(),
            AdminFormElement::text('color', trans('admin.lessons.color'))->required(),







//                new TranslatableText('name','Name')

//            AdminFormElement::text('translations', 'TitleTrans')->required(),
        ]
       //     + $name
        );

    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        $panel=AdminForm::panel();
        //$panel->getParameters();
        //var_dump($panel);
        $name = array();
//        dd(get_defined_vars()) ;
        foreach (Language::all() as $language){
//            dump($language);
            $name[]= AdminFormElement::text('name:'.$language->code, 'Name'.'('.$language->name.')')->required();
        }
        $panel->getButtons()->replaceButtons([
            'delete' => null, // Убираем кнопку Delete
            'save'   =>  AdminFormButton::save(),
        ]);
        return $panel->addBody([
//            AdminFormElement::text('code', 'Code')->setReadonly(true),
            AdminFormElement::select('type_id', trans('admin.type'),Type::class)->required()
                ->setDisplay('name')
            ,
//            AdminFormElement::select('class_status_id', trans('admin.status'),ClassStatus::class)->required()
//                ->setDisplay('name'),
            AdminFormElement::select('teacher_id', trans('admin.lessons.teacher'),Teacher::class)->required()
                ->setDisplay('user.name'),
            AdminFormElement::select('schedule_id', trans('admin.lessons.schedule'),Schedule::class)->required()
                ->setDisplay('name'),
            AdminFormElement::select('class_level_id', trans('admin.lessons.level'),ClassLevel::class)->required()
                ->setDisplay('name'),
            AdminFormElement::select('language_id', trans('admin.lessons.language'),Language::class)->required()
                ->setDisplay('name'),

            AdminFormElement::checkbox('visible', trans('admin.visible')),
//            AdminFormElement::checkbox('is_active', trans('admin.subscriptions.is_active')),
            AdminFormElement::translatabletext('name',trans('admin.name'))->required(),
            AdminFormElement::text('term',trans('admin.lessons.term') )
                ->required()->addValidationRule('regex:/^[1]{0,1}[0-9]{2}[M]{1}$/u'),
            AdminFormElement::translatabletext('term_text',trans('admin.subscriptions.term_text'))->required(),
            //       AdminFormElement::select('visible', trans('admin.visible') , ['false' , 'true'])->setDisplay('visible'),

            AdminFormElement::translatabletextarea('description',trans('admin.subscriptions.description'))->required(),
            AdminFormElement::datetime('start_time', trans('admin.lessons.start_time'))->setFormat('Y-m-d H:i:s')
                ->required(),
            AdminFormElement::text('color', trans('admin.lessons.color'))->required(),







//                new TranslatableText('name','Name')

//            AdminFormElement::text('translations', 'TitleTrans')->required(),
        ]);
    }

    /**
//     * @return void
//     */
//    public function onDelete($id)
//    {
//        // remove if unused
//    }
//
//    /**
//     * @return void
//     */
//    public function onRestore($id)
//    {
//        // remove if unused
//    }
}
