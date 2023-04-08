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
use App\Item;
use App\Subitem;
use App\Layout;
use App\Menu;
use App\Page;
use App\PageTranslation;
use App\View;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Subitems
 *
 * @property \Subitem $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Subitems extends Section
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
    protected $title = 'Subitems';
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
//        $a= AdminColumn::relatedLink('menu.name', trans('admin.menu'))->setName('menu.name')
//            ->setModel(new Menu())
//            ->setWidth('100px');
//        dd();
        return  $display
//            ->with('layout')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumnEditable::text('priority', trans('admin.priority'))->setWidth('20px'),
                AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
                    ->setLabel(trans('admin.visible'))->setWidth('40px'),
                AdminColumn::text('name', trans('admin.name'))->setWidth('100px'),
                AdminColumn::text('href_type',  trans('admin.href_type'))->setWidth('30px'),
                AdminColumn::text('href',  trans('admin.href'))->setWidth('100px'),
                AdminColumn::relatedLink('item.name', trans('admin.menu.item'))->setWidth('100px'),
                AdminColumn::relatedLink('item.menu.name', trans('admin.menus'))->setWidth('100px'),
////                AdminColumn::relatedLink('view.name', trans('admin.view'))->setName('view.name')->setWidth('100px'),
//                AdminColumn::lists('subitems.name', trans('admin.menu.subitems'))->setWidth('100px'),
//                AdminColumn::lists('pages.name', trans('admin.navigation.pages'))->setWidth('100px'),
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
            AdminFormElement::text('priority',  trans('admin.priority'))->required(),
            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::select('href_type', trans('admin.menu.href_type'))
            ->setEnum(['_self','_blank'])
//            ->setDisplay('href_type')
            ,
            AdminFormElement::text('href',  trans('admin.href'))->required(),
            AdminFormElement::translatabletext('title',trans('admin.menu.title'))->required(),

            AdminFormElement::select('item_id', trans('admin.menu.item'),Item::class)
//                ->setFetchColumns(['name'])
                ->setLoadOptionsQueryPreparer(function($element, $query) {
                    $menu_id=($element->getModel()->item->menu->id);
                    return $query
                       // ->where('menu_id', $menu_id)
//                        ->where('owner_id', $element->getModel()->author_id)
;
                    })
                ->setDisplay('title')
            ,
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
            AdminFormElement::text('priority',  trans('admin.priority'))->required(),
            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::select('href_type', trans('admin.menu.href_type'))
                ->setEnum(['_self','_blank'])
//            ->setDisplay('href_type')
            ,
            AdminFormElement::text('href',  trans('admin.href'))->required(),
            AdminFormElement::translatabletext('title',trans('admin.menu.title'))->required(),

            AdminFormElement::select('item_id', trans('admin.menu.item'),Item::class)
//                ->setFetchColumns(['name'])
                ->setLoadOptionsQueryPreparer(function($element, $query) {
//                    $menu_id=($element->getModel()->item->menu->id);
                    return $query
                        // ->where('menu_id', $menu_id)
//                        ->where('owner_id', $element->getModel()->author_id)
                        ;
                })
                ->setDisplay('title')
            ,
        ]);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}
