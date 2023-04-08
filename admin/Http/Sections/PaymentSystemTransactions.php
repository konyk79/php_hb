<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
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
class PaymentSystemTransactions extends Section
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
    protected $title = 'Transactions';

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
            ->with('notifications')
            ->with('subscribe')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('sum', 'sum'),
                AdminColumn::text('currency', 'currency'),
                AdminColumn::text('notifications.id', 'Notificaiton ID'),
                AdminColumn::text('subscribe.id', 'Subscribe ID'),
                AdminColumn::text('paymentSystem.name', 'Payment system'),
            ])->paginate(20)->setView('admin::default.display.table');
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
//    public function onEdit($id)
//    {
//        return AdminForm::panel()->addBody([
//            AdminFormElement::textarea('config', 'Config')->required(),
//            AdminFormElement::text('factoryName', 'Factory name')->required(),
//            AdminFormElement::text('payment_system_id', 'Gateway name')->required()
//        ]);
//    }

    /**
     * @return FormInterface
     */
//    public function onCreate()
//    {
//        return AdminForm::panel()->addBody([
//            AdminFormElement::textarea('config', 'Config')->required(),
//            AdminFormElement::text('factoryName', 'Factory name')->required(),
//            AdminFormElement::text('payment_system_id', 'Gateway name')->required()
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
