<?php
/**
 * Created by PhpStorm.
 * User: karol
 * Date: 23.05.16
 * Time: 15:31
 */

namespace KarGolSan\InstallWizard\Contracts;

interface WizardTrigger
{

    /**
     * Indicates if the wizard should be launched or not
     * 
     * @return boolean
     */
    function shouldLaunchWizard();
}