<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormButton;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Languages
 *
 * @property \App\Language $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Languages extends Section
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
    protected $title = 'Languages';

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
                AdminColumn::link('code', 'Code')->setWidth('500px'),
                AdminColumn::text('name', 'Name')->setWidth('500px'),
                AdminColumn::text('switcher_name', 'Switcher Name')->setWidth('30px'),
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
            AdminFormElement::text('code', 'Code')
                ->addValidationRule('regex:/^[a-z]{2}$/u')
                ->setReadonly(true),
            AdminFormElement::translatabletext('name', 'Name')->required(),
            AdminFormElement::translatabletext('switcher_name', 'Switcher Name')->required(),
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
            AdminFormElement::text('code', 'Code')
                ->addValidationRule('regex:/^[a-z]{2}$/u')
                ->required(),
            AdminFormElement::translatabletext('name', 'Name')->required(),
            AdminFormElement::translatabletext('switcher_name', 'Switcher Name')->required(),
        ]);
    }


//    /**
//     * @return void
//     */
    public function onDelete($id)
    {
        // todo: remove if unused
    }
}
