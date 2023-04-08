<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormButton;
use AdminFormElement;
use App\Country;
use App\Review;
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
class Reviews extends Section
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
    protected $title = 'Reviews';

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
//        $link = new \SleepingOwl\Admin\Display\ControlLink(function (\Illuminate\Database\Eloquent\Model $model) {
//            return '/admin/'.$model->getTable().'/'.$model->getKey().'/edit'; // Генерация ссылки
//        }, 'Edit Headers', 50);
//        $control = $display->getColumns()->getControlColumn();
//         $link->setIcon('fa fa-clone')->hideText();
//        $control->addButton($link);
        return  $display
//            ->with('layout')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
                    ->setLabel(trans('admin.visible'))->setWidth('40px'),
                AdminColumn::text('name', trans('admin.name'))->setWidth('100px'),
                AdminColumn::text('body', trans('admin.content.body'))->setWidth('500px'),
//                AdminColumn::url('image', trans('admin.content.image'))->setWidth('50px'),
                AdminColumn::relatedLink('country.name',trans('admin.navigation.countries'))->setWidth('50px')
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
        $panel->addBody([
            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::text('name', trans('admin.name'))->required(),
            AdminFormElement::translatabletextarea('body', trans('admin.content.body'))->required(),
            AdminFormElement::select('country_id', trans('admin.navigation.countries'),Country::class)->required()
            ->setDisplay('name'),

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
            AdminFormElement::text('name', trans('admin.name'))->required(),
            AdminFormElement::translatabletextarea('body', trans('admin.content.body'))->required(),
            AdminFormElement::select('country_id', trans('admin.navigation.countries'),Country::class)->required()
                ->setDisplay('name'),

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
