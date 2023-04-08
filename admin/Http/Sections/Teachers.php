<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use App\User;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Teachers
 *
 * @property \App\Teacher $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Teachers extends Section
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
    protected $title = 'Teachers';

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
//            ->with('users')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('100px'),
                AdminColumn::link('zoom_id', 'Zoom id')->setWidth('100px'),
                AdminColumn::text('zoom_private_id', 'Zoom private room id'),
                AdminColumn::relatedLink('user.name', 'User')->setWidth('200px'),
                AdminColumn::relatedLink('user.email', '')->setWidth('200px'),
//                AdminColumn::lists('users.name', 'Users')->setWidth('200px'),
            ])->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('zoom_id', 'Zoom id')->required(),
            AdminFormElement::text('zoom_private_id', 'Zoom private room id')->required(),
            AdminFormElement::select('user_id', 'Related user acount',User::class)->required()->setDisplay('email'),
        ]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('zoom_id', 'Zoom id')->required(),
            AdminFormElement::text('zoom_private_id', 'Zoom private room id')->required(),
            AdminFormElement::select('user_id', 'Related user acount',User::class)->required()->setDisplay('email'),
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
