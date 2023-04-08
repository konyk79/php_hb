<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormButton;
use AdminFormElement;
use App\Slider;
use App\SliderableModel;
use App\SliderTranslation;
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
class Sliders extends Section
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
   // protected $title = 'Sliders';

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
                AdminColumn::text('code', trans('admin.name'))->setWidth('100px'),
                AdminColumn::text('title', trans('admin.title'))->setWidth('100px'),
                AdminColumn::text('text', trans('admin.content.body'))->setWidth('600px'),
//                AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
                AdminColumn::text('href_text', trans('admin.content.href_title'))->setWidth('50px'),
                AdminColumn::url('href', trans('admin.href'))->setWidth('50px'),
//                AdminColumn::url('image', trans('admin.content.image'))->setWidth('50px'),
//                AdminColumn::url('video', trans('admin.content.video'))->setWidth('50px'),
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
//        dd(SliderableModel::all()->pluck(name)->get());
        $panel=AdminForm::panel();
        $panel->getButtons()->replaceButtons([
            'delete' => null, // Убираем кнопку Delete
            'save'   =>  AdminFormButton::save(),
        ]);
        //$panel->getParameters();
        //var_dump($panel);
        $panel->addBody([
            AdminFormElement::text('code', trans('admin.name'))->setReadonly(true),
//            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::translatabletext('title', trans('admin.title')),
            AdminFormElement::translatabletext('href_text', trans('admin.content.href_title')),
            AdminFormElement::translatabletext('text', trans('admin.content.body')),
//            AdminFormElement::text('image', trans('admin.content.image')),
//            AdminFormElement::text('video', trans('admin.content.video')),
            AdminFormElement::text('href', trans('admin.href')),
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
        //$panel->getParameters();
        //var_dump($panel);
        $panel->addBody([
            AdminFormElement::text('code', trans('admin.name')),
//            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::translatabletext('title', trans('admin.title')),
            AdminFormElement::translatabletext('href_text', trans('admin.content.href_title')),
            AdminFormElement::translatabletext('text', trans('admin.content.body')),
//            AdminFormElement::text('image', trans('admin.content.image')),
//            AdminFormElement::text('video', trans('admin.content.video')),
            AdminFormElement::text('href', trans('admin.href')),
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
