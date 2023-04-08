<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormButton;
use AdminFormElement;
use App\News;
use App\NewableModel;
use App\NewTranslation;
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
class SectionNews extends Section
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
    protected $title = 'News';

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
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('title', trans('admin.title'))->setWidth('100px'),
                AdminColumn::text('description', trans('admin.content.description'))->setWidth('600px'),
                AdminColumn::text('body', trans('admin.content.body'))->setWidth('600px'),
                AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide')),
                AdminColumn::url('image', trans('admin.content.image'))->setWidth('50px')
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
        $panel=AdminForm::panel();
        $panel->getButtons()->replaceButtons([
            'delete' => null, // Убираем кнопку Delete
            'save'   =>  AdminFormButton::save(),
        ]);
        $panel->addBody([
            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::translatabletext('title', trans('admin.title'))->required(),
            AdminFormElement::translatabletext('description', trans('admin.content.description'))->required(),
            AdminFormElement::ckeditor('body', trans('admin.content.body'))->required(),
            AdminFormElement::text('image', trans('admin.content.image'))->required(),
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
            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::translatabletext('title', trans('admin.title'))->required(),
            AdminFormElement::translatabletext('description', trans('admin.content.description'))->required(),
            AdminFormElement::ckeditor('body', trans('admin.content.body'))->required(),
            AdminFormElement::text('image', trans('admin.content.image'))->required(),
        ]);
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
