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
use App\UserHasSubscribe;
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
 * Class UserHasSubscribes
 *
 * @property \UserHasSubscribe $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class UserHasSubscribes extends Section
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
    protected $title = 'User\'s Subscriptions';
    /**
     * @var string
     */
    protected $alias;

    /**
     * @return DisplayInterface
     * id INT
    'user_id',
    'payment_system_id',
    'payment_system_refid',
    'status_id',
    'subscribe_id',
    'promo_id',
    'price',
    'is_active',
    'is_terminated',
    'is_confirmed'
     */
    public function onDisplay()
    {
        $display=AdminDisplay::datatables();

        $link = new \SleepingOwl\Admin\Display\ControlLink(function (\Illuminate\Database\Eloquent\Model $model) {
            return '/admin/'.$model->getTable().'/'.$model->getKey().'/unsubscribe'; // Генерация ссылки
        }, trans('admin.terminate_subscription'), 1000);
        $control = $display->getColumns()->getControlColumn();
        $link->setIcon('fa fa-ban')->hideText();
        $link->setHtmlAttribute('class','need_confirmation');
        $control->addButton($link);
        $link = new \SleepingOwl\Admin\Display\ControlLink(function (\Illuminate\Database\Eloquent\Model $model) {
            return '/admin/'.$model->getTable().'/'.$model->getKey().'/force-unsubscribe'; // Генерация ссылки
        }, trans('admin.force_terminate_subscription'), 1000);
        $control = $display->getColumns()->getControlColumn();
        $link->setIcon('fa fa-trash')->hideText();
        $link->setHtmlAttribute('class','need_confirmation');
        $control->addButton($link);

        $display->setView('admin::default.display.table');
        return  $display
//            ->setHtmlAttribute('class', 'table')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('20px'),
                AdminColumn::relatedLink('subscribe.name', trans('admin.name'))->setName('name')->setWidth('50px'),
                AdminColumn::text('price', trans('admin.subscriptions.price'))->setWidth('50px'),
                AdminColumn::relatedLink('user.email', trans('admin.navigation.users'))->setName('user.email')->setWidth('50px'),

                AdminColumn::relatedLink('status.name', trans('admin.status'))->setWidth('50px'),
                AdminColumn::custom( trans('admin.term'), function(\Illuminate\Database\Eloquent\Model $model) {
                    return ($model->subscribe->is_auto_prolangate)?trans('admin.yes'):trans('admin.no');
                })->setLabel(trans('admin.subscriptions.is_auto_prolangate'))->setWidth('30px'),
                AdminColumn::relatedLink('payment_system.name', trans('admin.navigation.payment_systems'))->setWidth('50px'),
                AdminColumn::relatedLink('promo.name', trans('admin.subscriptions.promos'))->setWidth('50px'),
//                AdminColumnEditable::checkbox('is_active')->setLabel('Active')->setWidth('30px'),
//                AdminColumnEditable::checkbox('is_confirmed')->setLabel('PSC')->setWidth('30px'),



//                AdminColumn::text( 'type.id' , trans('admin.type'))->setName('type.name')->setWidth('50px'),
//                AdminColumn::text('price', trans('admin.subscriptions.price').'$')->setWidth('20px'),
//                AdminColumn::relatedLink('discount.name', trans('admin.subscriptions.discount'))->setName('name')->setWidth('80px'),
//                AdminColumn::custom(trans('admin.visible'), function(\Illuminate\Database\Eloquent\Model $model) {
//                    return ($model->visible)?trans('admin.show'):trans('admin.hide');})->setWidth('40px'),
//                AdminColumn::custom( trans('admin.term'), function(\Illuminate\Database\Eloquent\Model $model) {
//                    $amount = substr($model->term, 0, -1);
//                    $period = substr($model->term, -1);
//                    $periodString='undefined';
//                    switch($period){
//                        case 'D':
//                            $periodString = trans('admin.days');
//                            break;
//                        case 'M':
//                            $periodString = trans('admin.months');
//                            break;
//                        case 'W':
//                            $periodString = trans('admin.weeks');
//                            break;
//                    }
//                    return $amount.' '.$periodString;
//                })->setWidth('60px'),
//                AdminColumn::datetime('expires_for', trans('admin.expired_date'))->setWidth('40px')
//                ->setFormat('d.m.Y'),
//                AdminColumn::text('id', trans('admin.subscriptions.description'))->setName('description')->setWidth('300px'),
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


//            ->setView('admin::default.display.table')

            ])
            ->addScript('terminateConfirmation','/packages/sleepingowl/default/js/button_confirmation.js');

    }

//    /**
//     * @param int $id
//     *
//     * @return FormInterface
//     */
//    public function onEdit($id)
//    {
//        $panel=AdminForm::panel();
//        $panel->getButtons()->replaceButtons([
//            'delete' => null, // Убираем кнопку Delete
//            'save'   =>  AdminFormButton::save(),
//        ]);
//            return $panel->addBody([
//
//                ]
//            );
//    }
//
//    /**
//     * @return FormInterface
//     */
//    public function onCreate()
//    {
//
//    }

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
