<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormButton;
use AdminFormElement;
//use GatewayConfig;
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
class PaymentSystems extends Section
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
    protected $title = 'Identities';

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
//            ->with('paymentProcessor')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('name', 'Name')->setWidth('100px'),
                AdminColumn::text('description', 'Description')->setWidth('200px'),
//                AdminColumn::text('paymentProcessor.id', 'Gateway ID')->setWidth('100px'),
//                AdminColumn::text('paymentProcessor.name', 'Gateway Name')->setWidth('100px'),
            ])->paginate(20)->setView('admin::default.display.table');
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $panel = AdminForm::panel();
        $panel->getButtons()->replaceButtons([
            'delete' => null, // Убираем кнопку Delete
            'save'   =>  AdminFormButton::save(),
        ]);
        return $panel->addBody([
            AdminFormElement::translatabletext('name', 'Key')->required(),
            AdminFormElement::translatabletextarea('description', 'Description')->required(),
//            AdminFormElement::select('paymentProcessor', 'Gateway', GatewayConfig::class)->setDisplay('name')
        ]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        $panel = AdminForm::panel();
        $panel->getButtons()->replaceButtons([
            'delete' => null, // Убираем кнопку Delete
            'save'   =>  AdminFormButton::save(),
        ]);
        return $panel->addBody([
            AdminFormElement::translatabletext('name', 'Key')->required(),
            AdminFormElement::translatabletextarea('description', 'Description')->required(),
//            AdminFormElement::select('paymentProcessor', 'Gateway', GatewayConfig::class)->setDisplay('name')
        ]);
    }


//    /**
//     * @return void
//     */
//    public function onDelete($id)
//    {
//        // todo: remove if unused
//    }
}
