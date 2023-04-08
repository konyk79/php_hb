<?php

namespace Admin\Http\Sections;

//use App\Form\Panel\CustomBlockClass;
use AdminColumnEditable;
use AdminFormButton;
use App\Country;
use App\Group;
use App\Role;
use App\Type;
use App\User;
//use AdminForm;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Facades\TableColumn as AdminColumn;
use SleepingOwl\Admin\Facades\Display as AdminDisplay;
use SleepingOwl\Admin\Facades\Form as AdminForm;
use SleepingOwl\Admin\Facades\FormElement as AdminFormElement;
use SleepingOwl\Admin\Facades\DisplayFilter as AdminDisplayFilter;
use SleepingOwl\Admin\Facades\TableColumnFilter as AdminColumnFilter;
////use App\Role;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Users
 *
 * @property \App\User $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Users extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     *
     */
    protected $model = User::class;
    protected $title = 'Users';
    protected $alias = 'users';


    public function initialize()
    {
        $page = \AdminNavigation::getPages()->findById('permissions');
//        dd( $page);
        $page->addPage(
            $this->makePage(300)->setTitle(trans('admin.navigation.users'))
        );
    }
    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
            $table1= AdminDisplay::datatablesAsync()
                ->setName('Users')
                 ->with('roles')
                ->with('groups')
//                ->setApply(function($query) {
//                    return $query->whereHas ('groups',  function($q) {
//                        $q->where('code', '<>', 'administration')->where('code', '<>', 'employees')
//                        ;
//                    })->doesntHave('groups','or')
//                        ;
//                    })
                ->setApply(function($query) {
                    return $query->whereHas ('roles',  function($q) {
                        $q->where('code', '<>', 'admin')->where('code', '<>', 'teacher')
                        ;
                    })
                        ->orWhereHas('groups',function($q) {
                        $q->where('code', '<>', 'administration')->where('code', '<>', 'employees')
                        ;
                    })
                        ;
                })
                ->setHtmlAttribute('class', 'table-primary')
                ->setColumns([
                    AdminColumnEditable::checkbox('email_confirmed', trans('admin.yes'),
                        trans('admin.no'),'Email confirmed')->setWidth('20px'),
                    AdminColumn::text('name', 'Name')->setWidth('150px'),
                    AdminColumn::email('email', 'Email')->setWidth('150px'),
                    AdminColumn::text('last_name', 'Last name')->setWidth('150px'),
                    AdminColumn::relatedLink('type.name', 'User type')->setWidth('50px'),
                    AdminColumn::text('phone', 'Phone')->setWidth('50px'),

                    AdminColumn::relatedLink('country.name', 'Country')->setWidth('50px'),
                    AdminColumn::text('corporate_name', ' Corporate name')->setWidth('50px'),
                    AdminColumn::link('corporate_web', ' Corporate web')->setWidth('50px'),

//                    AdminColumn::text('photo', 'Photo')->setWidth('50px'),
                    AdminColumn::lists('roles.name', 'Roles')->setWidth('50px'),
                    AdminColumn::lists('groups.name', 'Groups')->setWidth('50px'),
                ])->paginate(20)->setView('admin::default.display.table')
                ->setView('admin::default.display.table');
        $table2= AdminDisplay::datatablesAsync()
            ->with('roles')
            ->setApply(function($query) {
                return $query->whereHas ('roles',  function($q) {
                    $q->where('code',  'admin')->orWhere('code',  'teacher')
                    ;
                })
                    ->WhereHas('groups',function($q) {
                        $q->where('code',  'administration')->orWhere('code',  'employees')
                        ;
                    })
                    ;
            })
            ->setName('Employees')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumnEditable::checkbox('email_confirmed', trans('admin.yes'),
                    trans('admin.no'),'Email confirmed')->setWidth('20px'),
                AdminColumn::text('name', 'Name')->setWidth('150px'),
                AdminColumn::email('email', 'Email')->setWidth('150px'),
                AdminColumn::text('last_name', 'Last name')->setWidth('150px'),
                AdminColumn::relatedLink('type.name', 'User type')->setWidth('50px'),
                AdminColumn::text('phone', 'Phone')->setWidth('50px'),

                AdminColumn::relatedLink('country.name', 'Country')->setWidth('50px'),
                AdminColumn::text('corporate_name', ' Corporate name')->setWidth('50px'),
                AdminColumn::link('corporate_web', ' Corporate web')->setWidth('50px'),

//                    AdminColumn::text('photo', 'Photo')->setWidth('50px'),
                AdminColumn::lists('roles.name', 'Roles')->setWidth('50px'),
                AdminColumn::lists('groups.name', 'Groups')->setWidth('50px'),
            ])->paginate(20)->setView('admin::default.display.table')
            ->setView('admin::default.display.table');
        $table3= AdminDisplay::datatablesAsync()
            ->with('roles')
            ->setApply(function($query) {
                return $query->doesntHave ('roles', 'or')
                    ->doesntHave('groups', 'or')
                    ;
            })
            ->setName('Need to be config')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumnEditable::checkbox('email_confirmed', trans('admin.yes'),
                    trans('admin.no'),'Email confirmed')->setWidth('20px'),
                AdminColumn::text('name', 'Name')->setWidth('150px'),
                AdminColumn::email('email', 'Email')->setWidth('150px'),
                AdminColumn::text('last_name', 'Last name')->setWidth('150px'),
                AdminColumn::relatedLink('type.name', 'User type')->setWidth('50px'),
                AdminColumn::text('phone', 'Phone')->setWidth('50px'),

                AdminColumn::relatedLink('country.name', 'Country')->setWidth('50px'),
                AdminColumn::text('corporate_name', ' Corporate name')->setWidth('50px'),
                AdminColumn::link('corporate_web', ' Corporate web')->setWidth('50px'),

//                    AdminColumn::text('photo', 'Photo')->setWidth('50px'),
                AdminColumn::lists('roles.name', 'Roles')->setWidth('50px'),
                AdminColumn::lists('groups.name', 'Groups')->setWidth('50px'),
            ])->paginate(20)->setView('admin::default.display.table')
            ->setView('admin::default.display.table');
//        $table->setColumnFilters([
//            null,
//  AdminColumnFilter::text()->setPlaceholder('Full Name')->setOperator('contains'),
//  AdminColumnFilter::text()->setPlaceholder('email')->setOperator('contains')
//]);
//        $table->setActions([
//            AdminColumn::action('create', 'Create')->setMethod('GET')
//                ->setName('Создать')
//                ->setAction(route('admin.model.create','users')),
//        ]) ;
//        $table->getActions()
//            ->setPlacement('panel.footer')
//            ->setHtmlAttribute('class', 'pull-right')
//        ;
//        $form->addFooter($table);
//        $form->addElement(
//
//        );

        $tabs = AdminDisplay::tabbed();
//        $columns = AdminFormElement::columns()
//            ->addElement([$table2])
//            ->addColumn([$table3])
//            ->addColumn([$table4]);
        $tabs->appendTab(

                $table1
            ,
            //Название таба
            'Users'
        );
        $tabs->appendTab(
            $table2
            ,
            //Название таба
            'Employees'
        );
        $tabs->appendTab(
            $table3
            ,
            //Название таба
            'Need groups or roles'
        );
        return $tabs;
//        return $table;
    }

    /**
     * @param int $id
     *
     * @return FormInterface**/
    public function onEdit($id)
    {
        $panel=AdminForm::panel();
        $panel->getButtons()->replaceButtons([
            'delete' => null, // Убираем кнопку Delete
            'save'   =>  AdminFormButton::save(),
        ]);
        return $panel->addBody([
            AdminFormElement::text('name', 'Name')->required(),  //->setEditor('simplemde')
            AdminFormElement::text('last_name', 'Last Name')->required(),
            AdminFormElement::text('email', 'Email')->setValidationRules('required|string|email|max:255'),
            AdminFormElement::text('phone', 'Phone')->required()->addValidationRule('min:7'),
            AdminFormElement::select('type_id', 'User type',Type::class)->required()
            ->setDisplay('name'),
            AdminFormElement::select('country_id', 'Country',Country::class)->required()
                ->setDisplay('name'),
            AdminFormElement::checkbox('email_confirmed', 'Email confirmed'),
            AdminFormElement::multiselect('roles', 'Roles', Role::class)->setDisplay('name')->required(),
            AdminFormElement::multiselect('groups', 'Groups', Group::class)->setDisplay('name')->required(),
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
            AdminFormElement::text('name', 'Name')->required(),  //->setEditor('simplemde')
            AdminFormElement::text('last_name', 'Last Name')->required(),
            AdminFormElement::text('email', 'Email')->setValidationRules('required|string|email|max:255'),
            AdminFormElement::text('phone', 'Phone')->required()->addValidationRule('min:7'),
            AdminFormElement::select('type_id', 'User type',Group::class)->required()
                ->setLoadOptionsQueryPreparer(function($e,$q){
                    return $q->where('id','<', '4');
                })
                ->setDisplay('name'),
            AdminFormElement::select('country_id', 'Country',Country::class)->required()
                ->setDisplay('name'),
            AdminFormElement::password('password', 'Password')
                ->addValidationRule('min:6')->required(),
            AdminFormElement::checkbox('email_confirmed', 'Check email confirmed')->required()->setValue(true),
            AdminFormElement::html(trans('admin.attach_after_create'))
//                ->hashWithBcrypt()
////                ->allowEmptyValue()
//                ->setDefaultValue(User::find($id)->password)
//->setValue(User::find($id)->password)
//,
        ]);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // todo: remove if unused
    }
//
//    /**
//     * @return void
//     */
//    public function onRestore($id)
//    {
//        // todo: remove if unused
//    }
}
