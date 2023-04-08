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
 * Class ClassLevels
 *
 * @property \App\ClassLevel $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class ClassLevels extends Section
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
    protected $title = 'Class Levels';

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
                AdminColumn::lists('lessons.name', 'Lessons')->setWidth('700px'),
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
