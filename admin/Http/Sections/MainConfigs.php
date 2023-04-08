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
class MainConfigs extends Section implements Initializable
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
    protected $title = 'Main Configuration';
    /**
     * @var string
     */
    protected $alias = 'main_configs';
    public function initialize()
    {
        $page = \AdminNavigation::getPages()->findById('main_config');
        if ( $page) {
            $page->addPage(
                $this->makePage(0)
            );
        }
        $this->makePage(0);

    }
    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return redirect(url('/admin/main_configs/1/edit'));
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
            ->setIconClass('fa-ban')->setUrl(url('admin/main_configs/1/edit'))
            ]);
        return $panel->addBody([
            AdminFormElement::text('lesson_cancel_timeout', trans('admin.lesson_cancel_timeout'))
                ->required()->addValidationRule('regex:/^[0-9]{1,2}[M,S,H]{1}$/u'),
            AdminFormElement::text('lesson_before_start_timeout', trans('admin.lesson_before_start_timeout'))
                ->required()->addValidationRule('regex:/^[0-9]{1,2}[M,S,H]{1}$/u'),
            AdminFormElement::text('lesson_after_start_timeout',trans('admin.lesson_after_start_timeout') )
                ->required()->addValidationRule('regex:/^[0-9]{1,2}[M,S,H]{1}$/u'),
            AdminFormElement::text('slider_timeout', trans('admin.slider_timeout'))
                ->required()->addValidationRule('regex:/^[0-6]{0,1}[0-9][S]{1}$/u'),
            AdminFormElement::text('user_subscribe_timeout',trans('admin.user_subscribe_timeout') )
                ->required()->addValidationRule('regex:/^[0-5][D]{1}$/u'),
        ]);

    }

    /**
     * @return FormInterface
     */
//    public function onCreate()
//    {
//        return $this->onEdit(null);
//    }

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
