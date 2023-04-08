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
use App\LayoutTranslation;
use App\Page;
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
class Layouts extends Section
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
   // protected $title = 'Layouts';

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
        $link = new \SleepingOwl\Admin\Display\ControlLink(function (\Illuminate\Database\Eloquent\Model $model) {
            return '/admin/'.$model->getTable().'/'.$model->getKey().'/edit'; // Генерация ссылки
        }, 'Edit Headers', 50);
        return  $display
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('name', trans('admin.name'))->setWidth('100px'),
//                AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
//                    ->setLabel(trans('admin.visible'))->setWidth('40px'),
                AdminColumn::relatedLink('view.name', trans('admin.view'))->setName('view.name')->setWidth('100px'),
                AdminColumn::lists('headers.name', trans('admin.headers')),
                AdminColumn::lists('contents.name', trans('admin.contents')),
                AdminColumn::lists('footers.name', trans('admin.footers')),
                AdminColumn::lists('pages.name', trans('admin.navigation.pages'))
            ])->paginate(20)
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
            AdminFormElement::text('name', trans('admin.name'))->setReadonly(true),
//            AdminFormElement::checkbox('visible',trans('admin.visible')),
            AdminFormElement::select('id',  trans('admin.parent_page'),Page::class)->setDisplay('name'),
            AdminFormElement::select('id',  trans('admin.view'),View::class)->setDisplay('name')->setReadonly(true),
            AdminFormElement::multiselect('headers', trans('admin.headers'),Header::class)->setDisplay('name'),
            AdminFormElement::multiselect('footers', trans('admin.footers'),Footer::class)->setDisplay('name'),
            AdminFormElement::multiselect('contents', trans('admin.contents'),Content::class)->setDisplay('name'),
            //AdminFormElement::select('layout_id', trans('admin.layout'),Layout::class)->setDisplay('name')
        ]);
//
        if (!is_null($id)) { // Если галерея создана и у нее есть ID
            $footers = AdminDisplay::table()
                ->setModelClass(Footer::class) // Обязательно необходимо указать класс модели в которой хранятся фотографии
                ->setApply(function($query) use($id) {
                    $query->join('page_has_footers', 'page_has_footers.footer_id', '=', 'id')->where('page_has_footers.page_id', $id);
                })
                ->setParameter('category_id', $id) // При нажатии на кнопку "добавить" - подставлять идентификатор галереи
                ->setColumns(
                    AdminColumn::link('name', trans('admin.footers'))->setWidth('50px'),
                    AdminColumn::text('id', '#')->setWidth('30px'),
                    AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
                        ->setLabel(trans('admin.visible'))->setWidth('40px'),
                    AdminColumn::text('name', trans('admin.name'))->setWidth('100px'),
                    AdminColumn::relatedLink('menu.name', trans('admin.menus'))->setName('menu.name')->setWidth('100px'),
                    AdminColumn::relatedLink('view.name', trans('admin.view'))->setName('view.name')->setWidth('100px'),
                    AdminColumn::lists('contents.name', trans('admin.contents'))->setWidth('100px')
//                    AdminColumn::image('thumb', 'Фотгорафия')
//                        ->setHtmlAttribute('class', 'text-center')
//                        ->setWidth('100px')
                );
            $headers = AdminDisplay::table();

                $headers->setModelClass(Header::class) // Обязательно необходимо указать класс модели в которой хранятся фотографии
                ->setApply(function($query) use($id) {
                    $query->join('page_has_headers', 'page_has_headers.header_id', '=', 'id')->where('page_has_headers.page_id', $id);
//                    with('pages')->where('pages.id', $id); // Фильтруем список фотографий по ID галереи
//                   dd($query);
                })
                ->setParameter('category_id', $id) // При нажатии на кнопку "добавить" - подставлять идентификатор галереи

                ->setColumns(
                        AdminColumn::link('name', trans('admin.headers'))->setWidth('50px'),
                        AdminColumn::text('id', '#')->setWidth('30px'),
                        AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
                            ->setLabel(trans('admin.visible'))->setWidth('40px'),
                        AdminColumn::text('name', trans('admin.name'))->setWidth('100px'),
                        AdminColumn::relatedLink('menu.name', trans('admin.menus'))->setName('menu.name')->setWidth('100px'),
                        AdminColumn::relatedLink('view.name', trans('admin.view'))->setName('view.name')->setWidth('100px'),
                        AdminColumn::lists('contents.name', trans('admin.contents'))->setWidth('100px')
                );
            $contents = AdminDisplay::table();
            $contents->setModelClass(Content::class) // Обязательно необходимо указать класс модели в которой хранятся фотографии
            ->setApply(function($query) use($id) {
                $query
                    ->where('contents.contentable_type','=', Layout::class)
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

//            $menus = AdminDisplay::table();
//            $menus->setModelClass(Menu::class) // Обязательно необходимо указать класс модели в которой хранятся фотографии
//            ->setApply(function($query) use($id) {
////                dd($query);
//                $query->join('views', 'menus.view_id','=','views.id')
//                    ->join('pages', 'pages.view_id','=','views.id')
//                    ->where('pages.id',$id);
////                dd($query->toSql());
////
////                getQuery()  ->with('view', function ($query) use ($id){
////                        dd($query);
////                         $query;
////                    })
//                ;
//            })
//                ->setParameter('category_id', $id) // При нажатии на кнопку "добавить" - подставлять идентификатор галереи
//                ->setColumns(
//                    AdminColumn::text('id', '#')->setWidth('30px')
////                    AdminColumn::text('name', trans('admin.name'))->setWidth('100px'),
////                    AdminColumn::text('title', trans('admin.title'))->setWidth('100px'),
//////                AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
//////                    ->setLabel(trans('admin.visible'))->setWidth('40px'),
//////                AdminColumn::custom(trans('admin.visible'), function(\Illuminate\Database\Eloquent\Model $model) {
//////                    return ($model->visible)?trans('admin.show'):trans('admin.hide');
//////                })->setWidth('50px'),
////                    AdminColumn::text('href_title', trans('admin.content.href_title'))->setWidth('50px'),
////                    AdminColumn::url('href', trans('admin.href'))->setWidth('50px'),
////                    AdminColumn::url('image', trans('admin.content.image'))->setWidth('50px'),
////                    AdminColumn::url('video', trans('admin.content.video'))->setWidth('50px'),
////                    AdminColumn::text('body', trans('admin.content.body'))->setWidth('600px')
//                // AdminColumn::text('title')->setLabel('Заголовок'),
//                // AdminColumn::lists('contents.name', 'Блоки')
//                );
//            $panel->addBody($title);
            $panel->addBody($headers);
            $panel->addBody($footers);
            $panel->addBody($contents);
//            if(Header::find($id)->menu)
//                $panel->addBody($menus);

            }
        return $panel;
    }

    /**
     * @return FormInterface
     */
//    public function onCreate()
//    {
//
//    }


    /**
     * @return void
     */
//    public function onDelete($id)
//    {
//        // todo: remove if unused
//    }
}
