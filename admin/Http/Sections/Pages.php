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
 * Class Roles
 *
 * @property \App\Role $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Pages extends Section
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
   // protected $title = 'Pages';

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
//            ->with('layout')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::text('name', trans('admin.name'))->setWidth('100px'),
                AdminColumn::text('title', trans('admin.title'))->setWidth('100px'),
                AdminColumnEditable::checkbox('visible',trans('admin.show'), trans('admin.hide'))
                    ->setLabel(trans('admin.visible'))->setWidth('40px'),
//                AdminColumn::custom(trans('admin.visible'), function(\Illuminate\Database\Eloquent\Model $model) {
//                    return ($model->visible)?trans('admin.show'):trans('admin.hide');
//                })->setWidth('150px'),
                AdminColumn::text('favicon_title', trans('admin.favicon_title'))->setWidth('100px'),
                AdminColumn::lists('headers.name', trans('admin.headers'))->setWidth('100px'),
                AdminColumn::lists('contents.name', trans('admin.contents'))->setWidth('100px'),
                AdminColumn::relatedLink('layout.name', trans('admin.layout'))->setWidth('100px') ,
                AdminColumn::lists('footers.name', trans('admin.footers')) //->setModel(Footer::),
            ])->paginate(20)
                  ->addStyle('bootstrap', './css/bootstrap.min.css')
       ->addStyle('owl.carousel', './css/owl.carousel.min.css')
       ->addStyle('owl.theme', './css/owl.theme.default.css')
       ->addStyle('animate', './css/animate.css')
       ->addStyle('custom_style', './css/style.css')
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
        $panel->addBody([
            AdminFormElement::text('name', trans('admin.name'))->setReadonly(true),
            AdminFormElement::checkbox('visible',trans('admin.visible')),
            AdminFormElement::translatabletext('title', trans('admin.title'))
                ->required(),
            AdminFormElement::translatabletext('favicon_title', trans('admin.favicon_title'))
                ->required(),
            AdminFormElement::select('id',  trans('admin.parent_page'),Page::class)->setDisplay('name'),
            AdminFormElement::select('id',  trans('admin.view'),View::class)->setDisplay('name')->setReadonly(true),

//            AdminFormElement::text('title:en', 'Title(EN)')->required(),
//            AdminFormElement::text('translations', 'TitleTrans')->required(),



            AdminFormElement::multiselect('headers', trans('admin.headers'),Header::class)->setDisplay('name'),
            AdminFormElement::multiselect('footers', trans('admin.footers'),Footer::class)->setDisplay('name'),
            AdminFormElement::multiselect('contents', trans('admin.contents'),Content::class)->setDisplay('name'),
            AdminFormElement::select('layout_id', trans('admin.layout'),Layout::class)->setDisplay('name'),
//            AdminFormElement::select('layout', 'Layout',Layout::class)->setDisplay('name'),
         //   AdminFormElement::multiselect('footers', 'Footers', Role::class)->setDisplay('name'),
           // AdminFormElement::text('contentsname', 'Key')->required(),
//            AdminFormElement::wysiwyg('body', 'HTML')->required()
////                ->addStyle('bootstrap', './css/bootstrap.min.css')
////                ->addStyle('owl.carousel', './css/owl.carousel.min.css')
////                ->addStyle('owl.theme', './css/owl.theme.default.css')
////                ->addStyle('animate', './css/animate.css')
////                ->addStyle('custom_style', './css/style.css')
////                ->addScript('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js')
////                ->addScript('bootstrap', './js/bootstrap.min.js')
////                ->addScript('carousel', './js/owl.carousel.min.js')
////                ->addScript('wow', './js/wow.js')
////                ->addScript('main', './js/main.js')
//                ->disableFilter()
//                ->setEditor('tinymce')
//            ->setParameters(['Enable URL encoding to prevent web unsafe file names'=>false
//                ])
        ])
//            ->addStyle('bootstrap', './css/bootstrap.min.css')
//            ->addStyle('owl.carousel', './css/owl.carousel.min.css')
//            ->addStyle('owl.theme', './css/owl.theme.default.css')
//            ->addStyle('animate', './css/animate.css')
//            ->addStyle('custom_style', './css/style.css')
//            ->addScript('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js')
//            ->addScript('bootstrap', './js/bootstrap.min.js')
//            ->addScript('carousel', './js/owl.carousel.min.js')
//            ->addScript('wow', './js/wow.js')
//            ->addScript('main', './js/main.js')
//        ;
        //        $table->setActions([
//            AdminColumn::action('create', 'Create')->setMethod('GET')
//                ->setName('Создать')
//                ->setAction(route('admin.model.create','users')),
//        ]) ;
//        $panel->setAction(
//            AdminColumn::action('create', 'Create')->setMethod('GET')
//                ->setName('Предварительый Просмотр')
//                ->setAction(route('admin.page.preview',$id))
//
//        ) ;
//                $panel->getAction()
//        ->setHtmlAttribute('class', 'pull-right')
      ;
//        if (!is_null($id)) { // Если галерея создана и у нее есть ID
//            $title = AdminDisplay::table()
//                ->setModelClass(PageTranslation::class)// Обязательно необходимо указать класс модели в которой хранятся фотографии
//                ->setApply(function ($query) use ($id) {
//                    $query->where('page_id', $id);
////                    with('pages')->where('pages.id', $id); // Фильтруем список фотографий по ID галереи
////                   dd($query);
//                })
//                ->setParameter('category_id', $id)// При нажатии на кнопку "добавить" - подставлять идентификатор галереи
//                ->setColumns(
//                    AdminColumn::link('locale', 'Язык'),
////                    AdminColumn::text('visible')->setLabel('Отображение'),
//                    AdminColumn::text('title')->setLabel('Заголовок')
////                    AdminColumn::lists('contents.name', 'Блоки')
////                    AdminColumn::image('thumb', 'Фотгорафия')
////                        ->setHtmlAttribute('class', 'text-center')
////                        ->setWidth('100px')
//                );
//        }
        if (!is_null($id)) { // Если галерея создана и у нее есть ID
            $footers = AdminDisplay::table()
                ->setModelClass(Footer::class) // Обязательно необходимо указать класс модели в которой хранятся фотографии
                ->setApply(function($query) use($id) {
                    $query->join('page_has_footers', 'page_has_footers.footer_id', '=', 'id')->where('page_has_footers.page_id', $id);
//                    with('pages')->where('pages.id', $id); // Фильтруем список фотографий по ID галереи
//                   dd($query);
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
                    ->where('contents.contentable_type','=', Page::class)
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
