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
use App\Layout;
use App\Menu;
use App\Page;
use App\PageTranslation;
use App\View;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Headers
 *
 * @property \Header $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Headers extends Section
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
    protected $title = 'Headers';
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
        $a= AdminColumn::relatedLink('menu.name', trans('admin.menu'))->setName('menu.name')
            ->setModel(new Menu())
            ->setWidth('100px');
        return  $display
//            ->with('layout')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
                    ->setLabel(trans('admin.visible'))->setWidth('40px'),
                AdminColumn::text('name', trans('admin.name'))->setWidth('100px'),
                AdminColumn::relatedLink('menu', trans('admin.menus'))->setName('menu.name')->setWidth('100px'),
                AdminColumn::relatedLink('view.name', trans('admin.view'))->setName('view.name')->setWidth('100px'),
                AdminColumn::lists('contents.name', trans('admin.contents'))->setWidth('100px'),
                AdminColumn::lists('pages.name', trans('admin.navigation.pages'))->setWidth('100px'),
                AdminColumn::lists('layouts.name', trans('admin.layout'))->setWidth('100px'),
            ])
            ->setView('admin::default.display.table')
            ;
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
        $panel->addBody([
            AdminFormElement::text('name', 'Key')->required()->setReadonly(true),
            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::select('menu_id', trans('admin.menus'),Menu::class)
                ->setDisplay('name'),
            AdminFormElement::select('view_id', trans('admin.view'),View::class)->setReadonly(true)
                ->setDisplay('name'),
            AdminFormElement::multiselect('contents', trans('admin.contents'),Content::class)->setDisplay('name'),
            AdminFormElement::multiselect('pages', trans('admin.navigation.pages'),Page::class)->setDisplay('name'),
            AdminFormElement::multiselect('layouts', trans('admin.layout'),Layout::class)->setDisplay('name'),
        ]);
        $menus = AdminDisplay::table();
        $menus->setModelClass(Menu::class) // Обязательно необходимо указать класс модели в которой хранятся фотографии
        ->setApply(function($query) use($id) {
//                dd($query);
            $query
                ->select('menus.*')
                ->join('headers', 'headers.menu_id','=','menus.id')
                ->where('headers.id',$id);
//                dd($query->toSql());
//
//                getQuery()  ->with('view', function ($query) use ($id){
//                        dd($query);
//                         $query;
//                    })
            ;
        })
            ->setParameter('category_id', $id) // При нажатии на кнопку "добавить" - подставлять идентификатор галереи
            ->setColumns(
//                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('name', trans('admin.menus'))->setWidth('100px'),
                AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
                    ->setLabel(trans('admin.visible'))->setWidth('40px'),
//                AdminColumn::relatedLink('menu.name', trans('admin.menu'))->setName('menu.name')->setWidth('100px'),
                AdminColumn::relatedLink('view.name', trans('admin.view'))->setName('view.name')->setWidth('100px'),
                AdminColumn::lists('items.name', trans('admin.menu.items'))->setWidth('100px')
            );
        $contents = AdminDisplay::table();
        $contents->setModelClass(Content::class) // Обязательно необходимо указать класс модели в которой хранятся фотографии
        ->setApply(function($query) use($id) {
            $query
                ->where('contents.contentable_type','=', Header::class)
                ->where('contents.contentable_id', '=', $id)
            ;
        })
            ->setParameter('category_id', $id) // При нажатии на кнопку "добавить" - подставлять идентификатор галереи
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('name', trans('admin.contents'))->setWidth('100px'),
                AdminColumn::text('title', trans('admin.title'))->setWidth('100px'),
//                AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
//                    ->setLabel(trans('admin.visible'))->setWidth('40px'),
//                AdminColumn::custom(trans('admin.visible'), function(\Illuminate\Database\Eloquent\Model $model) {
//                    return ($model->visible)?trans('admin.show'):trans('admin.hide');
//                })->setWidth('50px'),
                AdminColumn::text('href_title', trans('admin.content.href_title'))->setWidth('50px'),
                AdminColumn::url('href', trans('admin.href'))->setWidth('50px'),
                AdminColumn::url('image', trans('admin.content.image'))->setWidth('50px'),
                AdminColumn::url('video', trans('admin.content.video'))->setWidth('50px'),
                AdminColumn::text('body', trans('admin.content.body'))->setWidth('600px')
            // AdminColumn::text('title')->setLabel('Заголовок'),
            // AdminColumn::lists('contents.name', 'Блоки')
            );
        $panel->addBody($contents);
        if (Header::find($id)->menu)
            $panel->addBody($menus);
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
            AdminFormElement::text('name', 'Key')->required(),
            AdminFormElement::checkbox('visible', trans('admin.visible')),
            AdminFormElement::select('menu_id', trans('admin.menus'),Menu::class)
                ->setDisplay('name'),
            AdminFormElement::select('view_id', trans('admin.view'),View::class)
                ->setDisplay('name')->required(),
            AdminFormElement::html(trans('admin.attach_after_create'))
        ]);

        return $panel;
     //   return $this->onEdit(null);
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
