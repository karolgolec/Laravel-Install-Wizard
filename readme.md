# Laravel Install Wizard

A Laravel package to help you build a web setup wizard for your application

![laravel-install-wizard](https://cloud.githubusercontent.com/assets/12084504/15552118/5cbd36aa-22b9-11e6-81b2-49b735bd7f61.png)

## Setup

### Add the package to your project

```
composer require kargolsan/laravel-install-wizard
```

### Declare the service provider and the alias

```php
'providers' => [
    /**
    * Other Service Providers
    */
    Collective\Html\HtmlServiceProvider::class, // for laravelcollective/html require
    KarGolSan\InstallWizard\ServiceProvider::class,
],

'aliases' => [
    /**
    * Other aliases
    */
    'Form' => Collective\Html\FormFacade::class, // for laravelcollective/html require
    'Html' => Collective\Html\HtmlFacade::class, // for laravelcollective/html require
    'InstallWizard' => KarGolSan\InstallWizard\Facades\InstallWizard::class,
],
```

### Declare the required middleware

Add the following line to your `app/Http/Kernel.php` file:

```php
protected $middlewareGroups = [
    // ...
    // Other Middleware
    // ...
    'install_wizard' => [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        'install_wizard.initializer',
    ]
];

protected $routeMiddleware = [
    // ...
    // Other Middleware
    // ...
    'install_wizard.initializer' => \KarGolSan\InstallWizard\Middleware\InstallWizardInitializer::class,
    'install_wizard.trigger'     => \KarGolSan\InstallWizard\Middleware\InstallWizardTrigger::class,
];
```

### Enable the middleware to launch the wizard if necessary

If you want to launch the install wizard automatically when required, you need to add the `SetupWizardTrigger` middleware
to the routes you wish to protect. For instance, if you have a route group to show an administration panel, you could 
do it there:

```php
Route::group([
    'prefix'     => 'admin', 
    'middleware' => 'install_wizard.trigger'
], function () {
        // ...
});
```

This way, the setup wizard will only be triggered when trying to access the administration panel.