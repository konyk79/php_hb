<?php

namespace Admin\Http\Sections;
use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormButton;
use AdminFormElement;
use App\Content;
use App\ContentTranslation;
use App\Discount;
use App\Footer;
use App\Group;
use App\Language;
use App\Subscribe;
use App\Layout;
use App\PageTranslation;
use App\Type;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
//use Admin\Form\Element\TranslatableText;
use Admin\Form\Element\TranslatableText;
use SleepingOwl\Admin\Section;

/**
 * Class Subscribes
 *
 * @property \Subscribe $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Subscribes extends Section
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
//    protected $title = 'Subscribes';
    /**
     * @var string
     */
    protected $alias;

    /**
     * @return DisplayInterface
     * id INT
    discount_id INT
    price REAL
    visible BOOLEAN
    priority INT
    code VARCHAR(5)
    name VARCHAR(65)T
    description TEXT T
    term_text VARCHAR(65)T
    term VARCHAR(65)
    is_auto_prolangate BOOLEAN
    is_active BOOLEAN
    valid_for DATE
    num_classes INT
    trial_term VARCHAR
    type_id INT
     */
    public function onDisplay()
    {
        $display=AdminDisplay::datatables();

        $link = new \SleepingOwl\Admin\Display\ControlLink(function (\Illuminate\Database\Eloquent\Model $model) {
            return '/admin/'.$model->getTable().'/'.$model->getKey().'/copy'; // Генерация ссылки
        }, trans('admin.copy'), 1000);
        $control = $display->getColumns()->getControlColumn();
        $link->setIcon('fa fa-clone')->hideText();
        $control->addButton($link);

        $link = new \SleepingOwl\Admin\Display\ControlLink(function (\Illuminate\Database\Eloquent\Model $model) {
            return '/admin/'.$model->getTable().'/'.$model->getKey().'/unsubscribe'; // Генерация ссылки
        }, trans('admin.terminate_subscription'), 1000);
       // $control = $display->getColumns()->getControlColumn();
        $link->setIcon('fa fa-ban')->hideText();
        $link->setHtmlAttribute('class','need_confirmation');
        $control->addButton($link);


        $display->setView('admin::default.display.table');
        return  $display
//            ->setHtmlAttribute('class', 'table')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('20px'),
                AdminColumn::text('code', trans('admin.code'))->setWidth('20px'),
                AdminColumnEditable::checkbox('is_active')->setLabel(trans('admin.subscriptions.is_active'))->setWidth('20px'),
//                AdminColumn::text('id', trans('admin.name'))->setName('name')->setWidth('50px'),
                AdminColumn::text('id', trans('admin.name'))->setName('name')->setWidth('50px'),
                AdminColumn::text('is_auto_prolangate', trans('admin.subscriptions.is_auto_prolangate'))->setWidth('20px'),
                AdminColumn::text( 'type.id' , trans('admin.type'))->setName('type.name')->setWidth('50px'),
                AdminColumn::text('price', trans('admin.subscriptions.price').'$')->setWidth('20px'),
                AdminColumn::relatedLink('discount.name', trans('admin.subscriptions.discount'))->setName('name')->setWidth('180px'),
                AdminColumn::custom(trans('admin.visible'), function(\Illuminate\Database\Eloquent\Model $model) {
                    return ($model->visible)?trans('admin.show'):trans('admin.hide');})->setWidth('40px'),
                AdminColumn::custom( trans('admin.term'), function(\Illuminate\Database\Eloquent\Model $model) {
                    $amount = substr($model->term, 0, -1);
                    $period = substr($model->term, -1);
                    $periodString='undefined';
                    switch($period){
                        case 'D':
                            $periodString = trans('admin.days');
                            break;
                        case 'M':
                            $periodString = trans('admin.months');
                            break;
                        case 'W':
                            $periodString = trans('admin.weeks');
                            break;
                    }
                    return $amount.' '.$periodString;
                })->setWidth('60px'),
                AdminColumn::datetime('expires_for', trans('admin.expired_date'))->setWidth('40px')
                ->setFormat('d.m.Y'),
                AdminColumn::text('id', trans('admin.subscriptions.description'))->setName('description')->setWidth('300px'),
                AdminColumn::lists('groups.code', trans('admin.groups'))->setWidth('100px'),
                AdminColumn::custom( trans('admin.subscriptions.promos'),  function(\Illuminate\Database\Eloquent\Model $model) {
                    $result ='';
                    foreach($model->promosName() as $key=>$value){
                        $result .= '<span class="label label-info">'.$value.'</span> ';
                    }
//                    dd($result);
                    return $result;

                })->setWidth('60px'),


//            ->setView('admin::default.display.table')

            ])
            ->addScript('terminateConfirmation','/packages/sleepingowl/default/js/button_confirmation.js');

    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $panel=AdminForm::panel();
//        $name = array();
//        foreach (Language::all() as $language){
//            $name[]= AdminFormElement::text('name:'.$language->code, 'Name'.'('.$language->name.')')->required();
//        }
        $panel->getButtons()->replaceButtons([
            'delete' => null, // Убираем кнопку Delete
            'save'   =>  AdminFormButton::save(),
        ]);
        $us=Subscribe::find($id);
        if (!$us->is_active  &&  stripos( $us->code,'copy')){
            return $panel->addBody([
                    AdminFormElement::text('code',  trans('admin.code')),
                    AdminFormElement::number( 'priority', trans('admin.priority'))->required(),
                    AdminFormElement::select('type_id', trans('admin.type'),Type::class)
                        ->setDisplay('name')->required()
                    ,

                    AdminFormElement::translatabletext('name', trans('admin.name'))->required(),
                    AdminFormElement::translatabletextarea('description', trans('admin.subscriptions.description'))->required(),
                    AdminFormElement::checkbox('visible', trans('admin.visible')),
                    AdminFormElement::checkbox('is_auto_prolangate', trans('admin.subscriptions.is_auto_prolangate')),
                    AdminFormElement::checkbox('is_active', trans('admin.subscriptions.is_active'))
                    ,
                    AdminFormElement::text('price',trans('admin.subscriptions.price') )
                        ->addValidationRule('regex:/^[0-9]{1,4}([.][0-9]{0,2}|)$/u')
                        ->required(),
                    AdminFormElement::text('term',trans('admin.subscriptions.term') )->required()
                        ->required()->addValidationRule('regex:/^[0-9]{1,2}[D,M,W]{1}$/u'),
                    AdminFormElement::translatabletext('term_text', trans('admin.subscriptions.term_text'))->required(),
                    AdminFormElement::text('trial_term',trans('admin.subscriptions.trial_term') )->required()
                        ->required()->addValidationRule('regex:/^[0-9]{1,2}[D]{1}$/u'),
                    AdminFormElement::date('expires_for', trans('admin.subscriptions.expires_for'))->setFormat('Y-m-d'),
                    AdminFormElement::number('num_classes', trans('admin.subscriptions.num_classes'))->required(),
                    AdminFormElement::select('discount_id', trans('admin.subscriptions.discount'),Discount::class)
                        ->setDisplay('name'),
                    AdminFormElement::multiselect('groups', trans('admin.groups'),Group::class)
                        ->setDisplay('name')     ,
                ]
            );
        }
        return $panel->addBody([
                AdminFormElement::text('code',  trans('admin.code'))->setReadonly(true),
                AdminFormElement::number( 'priority', trans('admin.priority'))->required(),
                AdminFormElement::select('type_id', trans('admin.type'),Type::class)
                    ->setDisplay('name')->required()
                ,


                AdminFormElement::checkbox('visible', trans('admin.visible')),
                AdminFormElement::checkbox('is_auto_prolangate', trans('admin.subscriptions.is_auto_prolangate')),
                AdminFormElement::checkbox('is_active', trans('admin.subscriptions.is_active'))
                ,
                AdminFormElement::translatabletext('name', trans('admin.name'))->required(),
                AdminFormElement::translatabletextarea('description', trans('admin.subscriptions.description'))->required(),

                AdminFormElement::text('price',trans('admin.subscriptions.price') )
                    ->addValidationRule('regex:/^[0-9]{1,4}([.][0-9]{0,2}|)$/u')
                    ->required(),
                AdminFormElement::text('term',trans('admin.subscriptions.term') )->required()
                    ->required()->addValidationRule('regex:/^[0-9]{1,2}[D,M,W]{1}$/u'),
                AdminFormElement::translatabletext('term_text', trans('admin.subscriptions.term_text'))->required(),
                AdminFormElement::text('trial_term',trans('admin.subscriptions.trial_term') )->required()
                    ->required()->addValidationRule('regex:/^[0-9]{1,2}[D]{1}$/u'),
                AdminFormElement::date('expires_for', trans('admin.subscriptions.expires_for'))->setFormat('Y-m-d'),
                AdminFormElement::number('num_classes', trans('admin.subscriptions.num_classes'))->required(),
                AdminFormElement::select('discount_id', trans('admin.subscriptions.discount'),Discount::class)
                    ->setDisplay('name'),
                AdminFormElement::multiselect('groups', trans('admin.groups'),Group::class)
                    ->setDisplay('name')     ,
        ]
        );

    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        $panel=AdminForm::panel();
//        $name = array();
//        foreach (Language::all() as $language){
//            $name[]= AdminFormElement::text('name:'.$language->code, 'Name'.'('.$language->name.')')->required();
//        }
        $panel->getButtons()->replaceButtons([
            'delete' => null, // Убираем кнопку Delete
            'save'   =>  AdminFormButton::save(),
        ]);
        return $panel->addBody([
                AdminFormElement::text('code',  trans('admin.code'))->required(),
                AdminFormElement::number( 'priority', trans('admin.priority'))->required(),
                AdminFormElement::select('type_id', trans('admin.type'),Type::class)
                    ->setDisplay('name')->required()
                ,


                AdminFormElement::checkbox('visible', trans('admin.visible')),
                AdminFormElement::checkbox('is_auto_prolangate', trans('admin.subscriptions.is_auto_prolangate')),
                AdminFormElement::checkbox('is_active', trans('admin.subscriptions.is_active'))
                ,
                AdminFormElement::translatabletext('name', trans('admin.name'))->required(),
                AdminFormElement::translatabletextarea('description', trans('admin.subscriptions.description'))->required(),
                AdminFormElement::text('price',trans('admin.subscriptions.price') )
                    ->addValidationRule('regex:/^[0-9]{1,4}([.][0-9]{0,2}|)$/u')
                    ->required(),
                AdminFormElement::text('term',trans('admin.subscriptions.term') )
                    ->required()->addValidationRule('regex:/^[0-9]{1,2}[D,M,W]{1}$/u'),
                AdminFormElement::translatabletext('term_text', trans('admin.subscriptions.term_text'))->required(),
                AdminFormElement::text('trial_term',trans('admin.subscriptions.trial_term') )->required()
                    ->required()->addValidationRule('regex:/^[0-9]{1,2}[D]{1}$/u'),
                AdminFormElement::date('expires_for', trans('admin.subscriptions.expires_for'))->setFormat('Y-m-d'),
                AdminFormElement::number('num_classes', trans('admin.subscriptions.num_classes'))->required(),
                AdminFormElement::html(trans('admin.attach_after_create'))
//                AdminFormElement::multiselect('groups', trans('admin.groups'),Group::class)
//                    ->setDisplay('name')     ,
            ]
        );
    }

    /**
//     * @return void
//     */
//    public function onDelete($id)
//    {
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
