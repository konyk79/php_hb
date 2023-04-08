<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormButton;
use AdminFormElement;
use App\Promo;
use App\Subscribe;
use App\User;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Groups
 *
 * @property \App\Group $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Groups extends Section
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
    protected $title = 'Groups';

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
                AdminColumn::link('code', 'Code')->setWidth('150px'),
                AdminColumn::text('name', 'Name')->setWidth('150px'),
                AdminColumn::text('description', 'Description')->setWidth('30px'),
                AdminColumn::lists('users.email', 'Users')->setWidth('150px'),
                AdminColumn::lists('promos.name', 'Promotions')->setWidth('150px'),
                AdminColumn::lists('subscribes.name', 'Subscribes')->setWidth('150px'),
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
            AdminFormElement::translatabletext('description', 'Description')->required(),
            AdminFormElement::multiselect('users', 'Users',User::class)
                ->setDisplay('email'),
            AdminFormElement::multiselect('promos', 'Promotions',Promo::class)->setDisplay('name'),
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
            AdminFormElement::translatabletext('name', 'Name')->required(),
            AdminFormElement::translatabletext('description', 'Description')->required(),
            AdminFormElement::html(trans('admin.attach_after_create'))
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
