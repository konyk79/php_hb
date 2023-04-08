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
use App\Item;
use App\Menu;
use App\Layout;
use App\Page;
use App\PageTranslation;
use App\View;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Menus
 *
 * @property \Menu $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Menus extends Section
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
    protected $title = 'Menus';
    /**
     * @var string
     */
    protected $alias;

    public function __construct (\Illuminate\Contracts\Foundation\Application $app, $class) {
        $this->title = trans('admin.navigation.menus');
        parent::__construct($app, $class);
    }
    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display=AdminDisplay::datatables();
        $a= AdminColumn::relatedLink('menu.name', trans('admin.menu'))->setName('menu.name')
            ->setModel(new Menu())
            ->setWidth('100px');
        return  $display
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
                    ->setLabel(trans('admin.visible'))->setWidth('40px'),
                AdminColumn::text('name', trans('admin.name'))->setWidth('100px'),
                AdminColumn::relatedLink('view.name', trans('admin.view'))->setName('view.name')->setWidth('100px'),
                AdminColumn::lists('items.name', trans('admin.menu.items'))->setWidth('100px'),
                AdminColumn::lists('headers', trans('admin.navigation.headers'),Header::class)->setName('headers.name')->setWidth('100px'),
                AdminColumn::lists('footers', trans('admin.navigation.footers'),Footer::class)->setName('footers.name')->setWidth('100px'),


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
        return $panel->addBody([
            AdminFormElement::text('name', trans('admin.name'))->required()->setReadonly(true),
            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::select('view_id', trans('admin.view'),View::class)
                ->setDisplay('name')->setReadonly(true),
            AdminFormElement::multiselect('items', trans('admin.menu.items'),Item::class)->setDisplay('name'),
            AdminFormElement::multiselect('headers', trans('admin.navigation.headers'),Header::class)->setDisplay('name'),
            AdminFormElement::multiselect('footers', trans('admin.navigation.footers'),Footer::class)->setDisplay('name'),
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
        return $panel->addBody([
            AdminFormElement::text('name', trans('admin.name'))->required(),
            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::select('view_id', trans('admin.view'),View::class)
                ->setDisplay('name')->required(),
//            AdminFormElement::multiselect('items', trans('admin.menu.items'),Item::class)->setDisplay('name'),
//            AdminFormElement::multiselect('headers', trans('admin.navigation.headers'),Header::class)->setDisplay('name'),
//            AdminFormElement::multiselect('footers', trans('admin.navigation.footers'),Footer::class)->setDisplay('name'),
            AdminFormElement::html(trans('admin.attach_after_create'))
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
