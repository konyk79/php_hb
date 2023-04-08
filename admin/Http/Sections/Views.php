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
use App\Footer;
use App\Header;
use App\Page;
use App\View;
use App\Menu;
use App\ViewTranslation;
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
class Views extends Section
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
   // protected $title = 'Views';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display=AdminDisplay::datatables();
        $link = new \SleepingOwl\Admin\Display\ControlLink(function (\Illuminate\Database\Eloquent\Model $model) {
            return '/admin/'.$model->getTable().'/'.$model->getKey().'/edit'; // Генерация ссылки
        }, 'Edit Headers', 50);
//        $control = $display->getColumns()->getControlColumn();
//         $link->setIcon('fa fa-clone')->hideText();
//        $control->addButton($link);
        return  $display
//            ->with('layout')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('name', trans('admin.name'))->setWidth('100px'),
                AdminColumn::lists('headers.name', trans('admin.headers')),
//                AdminColumn::lists('contents.name', trans('admin.contents')),
                AdminColumn::lists('footers.name', trans('admin.footers')),
                AdminColumn::lists('pages.name', trans('admin.navigation.pages')),
                AdminColumn::lists('layouts.name', trans('admin.navigation.layouts'))
            ])->paginate(20)->setView('admin::default.display.table');;
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
            'save'   =>  null,
        ]);
        $panel->addBody([
            AdminFormElement::text('name', trans('admin.name'))->setReadonly(true),


//            AdminFormElement::multiselect('headers', trans('admin.headers'),Header::class)->setDisplay('name'),
//            AdminFormElement::multiselect('footers', trans('admin.footers'),Footer::class)->setDisplay('name'),
//            AdminFormElement::multiselect('pages', trans('admin.pages'),Page::class)->setDisplay('name'),
//            AdminFormElement::select('layout_id', trans('admin.layout'),View::class)->setDisplay('name')
        ]);
//
        return $panel;
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
        $panel->addBody([
            AdminFormElement::text('name', trans('admin.name')),


//            AdminFormElement::multiselect('headers', trans('admin.headers'),Header::class)->setDisplay('name'),
//            AdminFormElement::multiselect('footers', trans('admin.footers'),Footer::class)->setDisplay('name'),
//            AdminFormElement::multiselect('pages', trans('admin.pages'),Page::class)->setDisplay('name'),
//            AdminFormElement::select('layout_id', trans('admin.layout'),View::class)->setDisplay('name')
        ]);
//
        return $panel;
    }


    /**
     * @return void
     */
    public function onDelete($id)
    {
        // todo: remove if unused
    }
}
