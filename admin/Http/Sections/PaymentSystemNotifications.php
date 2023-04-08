<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use Payum\LaravelPackage\Model\GatewayConfig;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Roles
 *
 * @property \App\Role $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class PaymentSystemNotifications extends Section
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
    protected $title = 'Notifications';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {

        return AdminDisplay::datatables()
            ->with('paymentSystem')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('message_id', '#')->setWidth('30px'),
                AdminColumn::text('message_body', 'Message Body')->setWidth('600px'),
                AdminColumn::text('is_processed', 'Being processed')->setWidth('50px'),
//                AdminColumn::text('paymentProcessor.id', 'Gateway ID')->setWidth('100px'),
                AdminColumn::text('paymentSystem.name', 'Payment system')->setWidth('100px'),
            ])->paginate(20)->setView('admin::default.display.table');
    }

//    /**
//     * @param int $id
//     *
//     * @return FormInterface
//     */
//    public function onEdit($id)
//    {
//        return AdminForm::panel()->addBody([
//            AdminFormElement::text('name', 'Key')->required(),
//            AdminFormElement::textarea('description', 'Description')->required(),
//            AdminFormElement::select('paymentProcessor', 'Gateway', GatewayConfig::class)->setDisplay('name')
//        ]);
//    }
//
//    /**
//     * @return FormInterface
//     */
//    public function onCreate()
//    {
//        return AdminForm::panel()->addBody([
//            AdminFormElement::text('name', 'Key')->required(),
//            AdminFormElement::text('code', 'Code')->required()
//        ]);
//    }


    /**
     * @return void
     */
//    public function onDelete($id)
//    {
//        // todo: remove if unused
//    }
}
