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
use App\Field;
use App\Footer;
use App\Form;
use App\Layout;
use App\Page;
use App\PageTranslation;
use App\View;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Forms
 *
 * @property \Form $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Forms extends Section
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
    protected $title = 'Forms';
    /**
     * @var string
     */
    protected $alias;

    public function __construct (\Illuminate\Contracts\Foundation\Application $app, $class) {
        $this->title = trans('admin.navigation.forms');
        parent::__construct($app, $class);
    }
    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display=AdminDisplay::datatables();
//        $a= AdminColumn::relatedLink('menu.name', trans('admin.menu'))->setName('menu.name')
//            ->setModel(new Form())
//            ->setWidth('100px');
        return  $display
//            ->with('layout')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
                    ->setLabel(trans('admin.visible'))->setWidth('40px'),
                AdminColumn::text('name', trans('admin.name'))->setWidth('100px'),
                AdminColumn::text('model', trans('admin.form.model'))->setWidth('30px'),
                AdminColumn::text('action', trans('admin.form.action'))->setWidth('30px'),
                AdminColumn::text('method', trans('admin.form.method'))->setWidth('30px'),
                AdminColumn::text('title', trans('admin.title'))->setWidth('30px'),
//                AdminColumn::text('submit_title', trans('admin.form.submit_title'))->setWidth('30px'),
//                AdminColumn::text('submit_title', trans('admin.form.cancel_title'))->setWidth('30px'),
//                AdminColumn::relatedLink('menu.name', trans('admin.menu'))->setName('menu.name')->setWidth('100px'),
                AdminColumn::relatedLink('view.name', trans('admin.view'))->setName('view.name')->setWidth('100px'),
                AdminColumn::lists('fields.name', trans('admin.menu.items'))->setWidth('100px'),
                AdminColumn::lists('pages.name', trans('admin.navigation.pages'))->setWidth('100px'),
//                AdminColumn::lists('layouts.name', trans('admin.layout'))->setWidth('100px'),


            ])
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
        //$panel->getParameters();
        //var_dump($panel);
        return $panel->addBody([
            AdminFormElement::text('name', trans('admin.name'))->required()->setReadonly(true),
            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::select('view_id', trans('admin.view'),View::class)
                ->setDisplay('name')->setReadonly(true),
            AdminFormElement::text('model', trans('admin.form.model'))->required(),
            AdminFormElement::text('action', trans('admin.form.action'))->required(),
            AdminFormElement::text('method', trans('admin.form.method'))->required(),
            AdminFormElement::translatabletext('title', trans('admin.title')),
            AdminFormElement::translatabletext('submit_title', trans('admin.form.submit_title')),
            AdminFormElement::translatabletext('cancel_title', trans('admin.form.cancel_title')),
            AdminFormElement::translatabletext('error_text', trans('admin.form.error_text')),
            AdminFormElement::translatabletext('success_text', trans('admin.form.success_text')),
            AdminFormElement::translatabletext('body_text', trans('admin.form.body_text')),
            AdminFormElement::multiselect('fields', trans('admin.form.fields'),Field::class)->setDisplay('name'),
            AdminFormElement::multiselect('pages', trans('admin.navigation.pages'),Page::class)->setDisplay('name'),
//            AdminFormElement::multiselect('layouts', trans('admin.layout'),Layout::class)->setDisplay('name'),
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
        //$panel->getParameters();
        //var_dump($panel);
        return $panel->addBody([
            AdminFormElement::text('name', trans('admin.name'))->required(),
            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::select('view_id', trans('admin.view'),View::class)
                ->setDisplay('name')->required() ,
            AdminFormElement::text('model', trans('admin.form.model'))->required(),
          AdminFormElement::text('action', trans('admin.form.action'))->required(),
            AdminFormElement::text('method', trans('admin.form.method'))->required(),
            AdminFormElement::text('title', trans('admin.title')),
            AdminFormElement::text('submit_title', trans('admin.form.submit_title')),
            AdminFormElement::text('cancel_title', trans('admin.form.cancel_title')),
            AdminFormElement::text('error_text', trans('admin.form.error_text')),
            AdminFormElement::text('success_text', trans('admin.form.success_text')),
            AdminFormElement::text('body_text', trans('admin.form.body_text')),
            AdminFormElement::html(trans('admin.attach_after_create'))
//            AdminFormElement::multiselect('fields', trans('admin.form.fields'),Field::class)->setDisplay('name'),
        ]);
    }

//    /**
//     * @return void
//     */
//    public function onDelete($id)
//    {
//        // remove if unused
//    }
//
//    /**
//     * @return void
//     */
//    public function onRestore($id)
//    {
//        // remove if unused
//    }
}
