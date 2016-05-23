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
    KarGolSan\InstallWizard\ServiceProvider::class,
],

'aliases' => [
    /**
    * Other aliases
    */
    'InstallWizard' => KarGolSan\InstallWizard\Facades\InstallWizard::class,
],
```
