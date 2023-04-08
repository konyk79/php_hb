<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormButton;
use AdminFormElement;
use App\Content;
use App\ContentableModel;
use App\ContentTranslation;
use App\Footer;
use App\Header;
use App\Layout;
use App\Page;
use App\PageTranslation;
use App\View;
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
class Contents extends Section
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
   // protected $title = 'Contents';

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
        return  $display
//            ->with('layout')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('name', trans('admin.name'))->setWidth('100px'),
                AdminColumn::text('title', trans('admin.title'))->setWidth('100px'),
                AdminColumn::text('href_title', trans('admin.content.href_title'))->setWidth('50px'),
                AdminColumn::url('href', trans('admin.href'))->setWidth('50px'),
                AdminColumn::url('image', trans('admin.content.image'))->setWidth('50px'),
                AdminColumn::url('video', trans('admin.content.video'))->setWidth('50px'),
                AdminColumn::text('body', trans('admin.content.body'))->setWidth('600px'),
                AdminColumn::relatedLink('contentable.name', trans('admin.content.contentable'))->setWidth('100px'),
//                AdminColumn::lists('footers.name', trans('admin.footers')) //->setModel(Footer::),
            ])->paginate(20)
                  ->addStyle('bootstrap', './css/bootstrap.min.css')
       ->addStyle('owl.carousel', './css/owl.carousel.min.css')
       ->addStyle('owl.theme', './css/owl.theme.default.css')
       ->addStyle('animate', './css/animate.css')
       ->addStyle('custom_style', './css/style.css')
            ->setView('admin::default.display.table');
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
//        dd(ContentableModel::all()->pluck(name)->get());
        $panel=AdminForm::panel();
        $panel->getButtons()->replaceButtons([
            'delete' => null, // Убираем кнопку Delete
            'save'   =>  AdminFormButton::save(),
        ]);
        //$panel->getParameters();
        //var_dump($panel);
        $panel->addBody([
            AdminFormElement::text('name', trans('admin.name'))->setReadonly(true),
//            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::translatabletext('title', trans('admin.title')),
            AdminFormElement::translatabletext('href_title', trans('admin.content.href_title')),
            AdminFormElement::translatabletext('body', trans('admin.content.body')),
            AdminFormElement::text('image', trans('admin.content.image')),
            AdminFormElement::text('video', trans('admin.content.video')),
            AdminFormElement::text('href', trans('admin.href')),
//            AdminFormElement::text('contentable_type', trans('admin.contentable_type'))->setReadonly(true),
//            AdminFormElement::text('contentable.name', trans('admin.dsfd'))->setReadonly(true),
            AdminFormElement::html(trans('admin.content.contentable').': '),
            AdminColumn::relatedLink('contentable.name', trans('admin.content.contentable'))->setWidth('100px')
//            AdminFormElement::select('contentable_type', trans('admin.contentable_type'),['App\Page','App\Layout','App\Header'])->setName('contentable_type'),
//
        ]);
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
//            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::translatabletext('title', trans('admin.title')),
            AdminFormElement::translatabletext('href_title', trans('admin.content.href_title')),
            AdminFormElement::translatabletext('body', trans('admin.content.body')),
            AdminFormElement::text('image', trans('admin.content.image')),
            AdminFormElement::text('video', trans('admin.content.video')),
            AdminFormElement::text('href', trans('admin.href')),
            ]);
        return $panel;
    }


//    /**
//     * @return void
//     */
//    public function onDelete($id)
//    {
//        // todo: remove if unused
//    }
}
