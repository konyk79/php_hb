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
 * Class Types
 *
 * @property \App\Type $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Types extends Section
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
    protected $title = 'Types';

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
                AdminColumn::link('code', 'Code')->setWidth('200px'),
                AdminColumn::text('name', 'Name')->setWidth('200px'),
                AdminColumn::lists('not_ended_lessons.name', 'Lessons of this type')->setWidth('400px'),
                AdminColumn::lists('active_subscribes.name', 'Subscriptions of this type')->setWidth('400px')
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
            AdminFormElement::translatabletext('name', 'Name')->required(),
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
            AdminFormElement::translatabletext('name', 'Name')->required(),
        ]);
    }


////    /**
////     * @return void
////     */
//    public function onDelete($id)
//    {
//        // todo: remove if unused
//    }
}
