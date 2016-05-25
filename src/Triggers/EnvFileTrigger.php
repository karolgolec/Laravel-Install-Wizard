<?php

namespace KarGolSan\InstallWizard\Triggers;

use KarGolSan\InstallWizard\Contracts\WizardTrigger;

/**
 * Class EnvFileTrigger
 *
 * @package KarGolSan\InstallWizard\Triggers
 *
 * Start the wizard if the application does not have yet an env file
 */
class EnvFileTrigger implements WizardTrigger
{

    /**
     * Indicates if the wizard should be launched or not
     *
     * @return boolean
     */
    function shouldLaunchWizard()
    {
        $envFilePath = base_path('.env');
        return !file_exists($envFilePath);
    }
}