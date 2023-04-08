<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormButton;
use AdminFormElement;
use App\Group;
use App\Discount;
use App\Subscribe;
use App\User;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Discounts
 *
 * @property \App\Discount $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Discounts extends Section
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
    protected $title = 'Discounts';

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
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumnEditable::checkbox('is_active',trans('admin.yes'), trans('admin.no'))
                    ->setLabel(trans('admin.subscriptions.is_active'))->setWidth('40px'),
                AdminColumn::link('code', 'Code')->setWidth('150px'),
                AdminColumn::text('name', 'Name')->setWidth('200px'),
                AdminColumn::text('discount', 'Discount')->setWidth('30px'),
                AdminColumn::lists('subscribes.name', 'Subscribe')->setWidth('300px'),
            ])->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $panel=AdminForm::panel();
        $panel->getButtons()->replaceButtons([
            'delete' => null, // Убираем кнопку Delete
            'save'   =>  AdminFormButton::save(),
        ]);
        return  $panel->addBody([
            AdminFormElement::text('code', 'Code')->setReadonly(true),
            AdminFormElement::checkbox('is_active', trans('admin.subscriptions.is_active')),
            AdminFormElement::translatabletext('name', 'Name')->required(),
            AdminFormElement::text('discount', 'Discount (-0.xx   exemple: -0.15  =  - 15% discount)')->required()
                ->addValidationRule('regex:/^[-]{1}[0]{1}[.][0-9]{1,2}$/u'),
            AdminFormElement::multiselect('subscribes', 'Subscribes',Subscribe::class)->setDisplay('name'),
        ]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        $panel=AdminForm::panel();
        $panel->getButtons()->replaceButtons([
            'delete' => null, // Убираем кнопку Delete
            'save'   =>  AdminFormButton::save(),
        ]);
        return  $panel->addBody([
            AdminFormElement::text('code', 'Code')->required(),
            AdminFormElement::checkbox('is_active', trans('admin.subscriptions.is_active')),
            AdminFormElement::translatabletext('name', 'Name')->required(),
            AdminFormElement::text('discount', 'Discount (-0.xx   exemple: -0.15  =  - 15% discount)')->required()
                ->addValidationRule('regex:/^[-]{1}[0]{1}[.][0-9]{1,2}$/u'),
            AdminFormElement::html(trans('admin.attach_after_create'))
        ]);
    }


    /**
     * @return void
     */
    public function onDelete($id)
    {
        // todo: remove if unused
    }
}
