<?php

namespace Admin\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormButton;
use AdminFormElement;
use App\SocialLink;
use App\SocialLinkableModel;
use App\SocialLinkTranslation;
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
class SocialLinks extends Section
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
    protected $title = 'SocialLinks';

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
//                AdminColumn::text('title', trans('admin.title'))->setWidth('100px'),
//                AdminColumn::text('text', trans('admin.content.body'))->setWidth('600px'),

//                AdminColumn::text('href_text', trans('admin.content.href_title'))->setWidth('50px'),
                AdminColumn::url('href', trans('admin.href'))->setWidth('50px'),
                AdminColumn::url('image', trans('admin.content.image'))->setWidth('50px'),
                AdminColumn::relatedLink('socialized.name',trans('admin.content.contentable'))->setWidth('50px')
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
//        dd(SocialLinkableModel::all()->pluck(name)->get());
        $panel=AdminForm::panel();
        $panel->getButtons()->replaceButtons([
            'delete' => null, // Убираем кнопку Delete
            'save'   =>  AdminFormButton::save(),
        ]);
        //$panel->getParameters();
        //var_dump($panel);
        $panel->addBody([
//            AdminFormElement::text('code', trans('admin.name'))->setReadonly(true),
            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::text('name', trans('admin.name')),
//            AdminFormElement::translatabletext('href_text', trans('admin.content.href_title')),
//            AdminFormElement::translatabletext('text', trans('admin.content.body')),
            AdminFormElement::text('image', trans('admin.content.image')),
//            AdminFormElement::text('video', trans('admin.content.video')),
            AdminFormElement::text('href', trans('admin.href')),
            AdminFormElement::select('socialized_type', trans('admin.social.socialized_type'))
//                ->setDefaultValue('App\Footer')
                ->setEnum(['App\Footer','App\Header'])->required(),

            AdminFormElement::dependentselect('socialized_id', 'Id')
                ->setModelForOptions(\App\Footer::class)
                ->setDisplay('name')
//                ->setDefaultValue(1)
                ->setDataDepends(['socialized_type'])
                ->setLoadOptionsQueryPreparer(function($item, $query) {
                    $class=$item->getDependValue('socialized_type');
                    if ($class!==null && class_exists($class)){
                        $item->setModelForOptions( $class::first(), 'name');
                        ($query=$class::query());
                    }
                    return $query;
                }),
            AdminFormElement::html(trans('admin.content.contentable').': '),
            AdminColumn::text('socialized_type' ),
            AdminColumn::relatedLink('socialized.name',trans('admin.content.contentable'))->setWidth('50px')
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
//            AdminFormElement::text('code', trans('admin.name'))->required(),
            AdminFormElement::text('name', trans('admin.name'))->required(),
            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::text('image', trans('admin.content.image'))->required(),
            AdminFormElement::text('href', trans('admin.href'))->required(),
            AdminFormElement::html(trans('admin.content.contentable').': '),
            AdminFormElement::select('socialized_type', trans('admin.social.socialized_type'))
                ->setDefaultValue('App\Footer')
                ->setEnum(['App\Footer','App\Header'])->required(),

            AdminFormElement::dependentselect('socialized_id', 'Id')
                ->setModelForOptions(\App\Footer::class)
                ->setDisplay('name')
                ->setDefaultValue(1)
                ->setDataDepends(['socialized_type'])
                ->setLoadOptionsQueryPreparer(function($item, $query) {
                   $class=$item->getDependValue('socialized_type');
                    if ($class!==null && class_exists($class)){
                        $item->setModelForOptions( $class::first(), 'name');
                        ($query=$class::query());
                    }
                    return $query;
                }),

            AdminColumn::text('socialized_type' ),
            AdminColumn::relatedLink('socialized.name',trans('admin.content.contentable'))->setWidth('50px')
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
