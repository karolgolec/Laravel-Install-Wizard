<?php

namespace KarGolSan\InstallWizard\Facades;

use Illuminate\Support\Facades\Facade;

class InstallWizard extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'InstallWizard';
    }
}