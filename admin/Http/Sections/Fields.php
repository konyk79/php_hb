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
 * Class Fields
 *
 * @property \Field $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Fields extends Section
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
    protected $title = 'Fields';
    /**
     * @var string
     */
    protected $alias;

    public function __construct (\Illuminate\Contracts\Foundation\Application $app, $class) {
        $this->title = trans('admin.navigation.fields');
        parent::__construct($app, $class);
    }
    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display=AdminDisplay::datatables();
//        $a= AdminColumn::relatedLink('menu.name', trans('admin.menu'))->setName('menu.name')
//            ->setModel(new Field())
//            ->setWidth('100px');
        return  $display
//            ->with('layout')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumnEditable::text('priority', trans('admin.priority'))->setWidth('30px'),
                AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
                    ->setLabel(trans('admin.visible'))->setWidth('40px'),
                AdminColumnEditable::checkbox('nullable',trans('admin.yes'), trans('admin.no'))
                    ->setLabel(trans('admin.form.nullable'))->setWidth('40px'),
                AdminColumnEditable::checkbox('required',trans('admin.yes'), trans('admin.no'))
                    ->setLabel(trans('admin.form.required'))->setWidth('40px'),
                AdminColumnEditable::checkbox('unique',trans('admin.yes'), trans('admin.no'))
                    ->setLabel(trans('admin.form.unique'))->setWidth('40px'),
                AdminColumn::text('name', trans('admin.name'))->setWidth('100px'),
                AdminColumn::text('label', trans('admin.form.label'))->setWidth('30px'),
                AdminColumn::text('type', trans('admin.form.type'))->setWidth('30px'),
                AdminColumn::text('placeholder', trans('admin.form.placeholder'))->setWidth('30px'),
                AdminColumn::relatedLink('form.name', trans('admin.form.form'))->setName('form.name')->setWidth('100px'),


            ])
            ->setView('admin::default.display.table');
    }

    /**
     * @param int $id
     *
     * @return FieldInterface
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
            AdminFormElement::checkbox('nullable', trans('admin.form.nullable')),
            AdminFormElement::checkbox('required', trans('admin.form.required')),
            AdminFormElement::checkbox('unique', trans('admin.form.unique')),
            AdminFormElement::checkbox('readonly', trans('admin.form.readonly')),
//            AdminFormElement::select('form_id', trans('admin.form.form'),Form::class)
//                ->setDisplay('name')->setReadonly(true),
            AdminFormElement::text('priority', trans('admin.priority'))->required(),
            AdminFormElement::text('type', trans('admin.form.type'))->required(),
            AdminFormElement::text('element', trans('admin.form.element'))->required(),
            AdminFormElement::text('default_val', trans('admin.form.default_val')),
            AdminFormElement::translatabletext('placeholder', trans('admin.form.placeholder')),
            AdminFormElement::translatabletext('label', trans('admin.form.label')),
            AdminFormElement::select('form_id', trans('admin.form.form'),Form::class)->setDisplay('name'),
//            AdminFormElement::multiselect('pages', trans('admin.navigation.pages'),Page::class)->setDisplay('name'),
//            AdminFormElement::multiselect('layouts', trans('admin.layout'),Layout::class)->setDisplay('name'),
        ]);

    }

    /**
     * @return FieldInterface
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
            AdminFormElement::checkbox('nullable', trans('admin.form.nullable')),
            AdminFormElement::checkbox('required', trans('admin.form.required')),
            AdminFormElement::checkbox('unique', trans('admin.form.unique')),
            AdminFormElement::checkbox('readonly', trans('admin.form.readonly')),
//            AdminFormElement::select('form_id', trans('admin.form.form'),Form::class)
//                ->setDisplay('name')->setReadonly(true),
            AdminFormElement::text('priority', trans('admin.priority'))->required(),
            AdminFormElement::text('type', trans('admin.form.type'))->required(),
            AdminFormElement::text('element', trans('admin.form.element'))->required(),
            AdminFormElement::text('default_val', trans('admin.form.default_val')),
            AdminFormElement::translatabletext('placeholder', trans('admin.form.placeholder')),
            AdminFormElement::translatabletext('label', trans('admin.form.label')),
            AdminFormElement::select('form_id', trans('admin.form.form'),Form::class)->setDisplay('name'),
        ]);
    }
//
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
