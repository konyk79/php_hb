<?php

namespace Admin\Http\Sections;
use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminFormButton;
use App\Content;
use App\ContentTranslation;
use App\Footer;
use App\Header;
use App\Layout;
use App\PageTranslation;
use Request;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\FormButton;
use SleepingOwl\Admin\Section;

use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndCreate;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\Delete;
use SleepingOwl\Admin\Form\Buttons\Cancel;

/**
 * Class Headers
 *
 * @property \Header $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class NewsConfigs extends Section {
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
//    protected $title = 'Main Configuration';
    /**
     * @var string
     */
//    protected $alias = 'main_configs';
//    public function initialize()
//    {
//        $page = \AdminNavigation::getPages()->findById('main_config');
//        if ( $page) {
//            $page->addPage(
//                $this->makePage(0)
//            );
//        }
//        $this->makePage(0);
//
//    }
    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return redirect(url('/admin/page_has_news/1/edit'));
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
            'cancel' => (new FormButton())
                ->setText(AdminFormButton::cancel()->getText())
                ->setHtmlAttributes(['class' => 'btn btn-warning'])
                ->setName('cancel')
            ->setIconClass('fa-ban')->setUrl(url('admin/page_has_news/1/edit'))
            ]);
        return $panel->addBody([
            AdminFormElement::text('paginate', trans('admin.news.paginate'))
                ->required()->addValidationRule('numeric'),
            AdminFormElement::translatabletext('more_button_text', trans('admin.news.more_btn'))
                ->required(),
        ]);

    }

    /**
     * @return FormInterface
     */
//    public function onCreate()
//    {
//        return $this->onEdit(null);
//    }

    /**
     * @return void
     */
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
