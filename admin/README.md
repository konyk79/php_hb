## Installation for sleeping owl admin

- Put extracted package to {project-root}/admin
- Add to composer.json:
          in required      "laravelrus/sleepingowl": "4.*@dev"
          in "psr-4": {
                         
                         "Admin\\": "admin/"
          "scripts": {
                                 "post-update-cmd": [
                                     "Illuminate\\Foundation\\ComposerScripts::postUpdate",
                                     "php artisan sleepingowl:update"
                                 ]
- Add service provider to `config/app.php` file following line: 
/*
 * SleepingOwl Service Provider
 */
        SleepingOwl\Admin\Providers\SleepingOwlServiceProvider::class,
        Admin\Providers\AdminSectionsServiceProvider::class,

- Publish assets by running `php artisan vendor:publish --tag=admin-custom --force`
`$ php artisan vendor:publish --tag=assets --force`


## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
