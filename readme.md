# Laravel Install Wizard

A Laravel package to help you build a web setup wizard for your application

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
