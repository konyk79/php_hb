<?php

namespace App\Providers;

use App\PaymentAgreementDetails;
use App\RecurringPayment;
use Blade;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!Collection::hasMacro('paginate')) {

            Collection::macro('paginate',
                function ($perPage = 15, $page = null, $options = []) {
                    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                    return (new LengthAwarePaginator(
                        $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
                        ->withPath('');
                });
        }

        Blade::directive('includeIfExist', function ($view) {
            if (strpos($view, ',') !== false) {
                list($v, $arg) = explode(',', $view, 2);
                return " 
                <?php if(View::exists(with({$v}))): ?>
                <?php     echo \$__env->make(with({$v}),{$arg},
                array_except(get_defined_vars(), array('__data', '__path')))->render();?>
                <?php endif; ?>";
            } else {
//                $v=$view;
                return " 
                <?php if(View::exists(with({$view}))): ?>
                <?php     echo \$__env->make(with({$view}),
                array_except(get_defined_vars(), array('__data', '__path')))->render();?>
                <?php endif; ?>";
            }

        });
        Blade::directive('contentImage', function ($name) {
            return " 
            <?php if(\$content=\$self->getContentByName(with({$name}))): ?>
            <?php     echo \$content->image ;?>
            <?php endif; ?>";

        });
        Blade::directive('contentVideo', function ($name) {
            return " 
            <?php if(\$content=\$self->getContentByName(with({$name}))): ?>
            <?php     echo \$content->video ;?>
            <?php endif; ?>";

        });
        Blade::directive('contentTitle', function ($name) {
            return " 
            <?php if(\$content=\$self->getContentByName(with({$name}))): ?>
            <?php echo \$content->title;?>
            <?php endif; ?>";

        });
        Blade::directive('contentText', function ($name) {
            return "<?php if(\$content=\$self->getContentByName(with({$name}))): ?><?php echo (trim(with(\$content->body)));?><?php endif; ?>";
        });
        Blade::directive('contentHref', function ($name) {
            return " 
            <?php if(\$content=\$self->getContentByName(with({$name}))): ?>
            <?php     echo \$content->render();?>
            <?php endif; ?>";

        });
        Blade::directive('contentHrefText', function ($name) {
            return " 
            <?php if(\$content=\$self->getContentByName(with({$name}))): ?>
            <?php     echo \$content->href_title;?>
            <?php endif; ?>";

        });
        Blade::directive('contentHref', function ($name) {
            return " 
            <?php if(\$content=\$self->getContentByName(with({$name}))): ?>
            <?php     echo \$content->href;?>
            <?php endif; ?>";

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->resolving('payum.builder', function(\Payum\Core\PayumBuilder $payumBuilder) {
            $payumBuilder
                // this method registers filesystem storages, consider to change them to something more
                // sophisticated, like eloquent storage
                ->addDefaultStorages()

                // TODO investigate following
//                ->setTokenStorage(new FilesystemStorage(sys_get_temp_dir(), Token::class, 'hash'))

                ->addStorage(Payment::class, new EloquentStorage(Payment::class))
                ->addStorage(PaymentAgreementDetails::class, new FilesystemStorage(sys_get_temp_dir(), ArrayObject::class))
//                ->addStorage(RecurringPayment::class, new FilesystemStorage(sys_get_temp_dir(), ArrayObject::class))
                ->addStorage(RecurringPayment::class, new EloquentStorage(RecurringPayment::class))
                //->setTokenStorage(new EloquentStorage(Token::class))
                //->addStorage(ArrayObject::class, new FilesystemStorage(sys_get_temp_dir(), ArrayObject::class))
                //->addStorage(Payout::class, new FilesystemStorage(sys_get_temp_dir(), Payout::class))

                // Loading Gateways configuration from database
                ->setGatewayConfigStorage(new EloquentStorage(GatewayConfig::class))
            ;
        });
    }
}
