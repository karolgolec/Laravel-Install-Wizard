<?php

return [

    /**
     * -----------------------------------------------------------------------
     * Routing
     * -----------------------------------------------------------------------
     *
     * You can configure the routing for the wizard here (or even turn it off
     * altogether)
     */

    'routing' => [
        // Load the routes specified by the package, if not, you have to create
        // the routes by yourself in your project's route file
        'load_default' => true,

        // When using default routes, here are some ways to customize them
        'prefix' => 'install',

        // Once the wizard completes, you can redirect to a specific route name
        'success_route' => '',

        // Once the wizard completes, you can redirect to a specific route url
        // (if not using the success route name)
        'success_url' => '',
    ],

    /**
     * -----------------------------------------------------------------------
     * Triggers
     * -----------------------------------------------------------------------
     *
     * Triggers are used to determine if the wizard has to be ran. Each of the
     * triggers is a class which implements the
     * KarGolSan\InstallWizard\Contracts\WizardTrigger interface
     */

    'triggers' => [
        \KarGolSan\InstallWizard\Triggers\EnvFileTrigger::class,
    ],

    /**
     * -----------------------------------------------------------------------
     * Steps
     * -----------------------------------------------------------------------
     *
     * Each step will be ran in order. Each of the step is a class which
     * implements the KarGolSan\InstallWizard\Contracts\WizardStep interface
     */

    'steps' => [
        'requirements' => \KarGolSan\InstallWizard\Steps\RequirementsStep::class,
        'folders' => \KarGolSan\InstallWizard\Steps\FoldersStep::class,
        'env' => \KarGolSan\InstallWizard\Steps\EnvFileStep::class,
        'database' => \KarGolSan\InstallWizard\Steps\DatabaseStep::class,
        'final' => \KarGolSan\InstallWizard\Steps\FinalStep::class,
    ],

    /**
     * -----------------------------------------------------------------------
     * Theming
     * -----------------------------------------------------------------------
     *
     * You can indicate the name of the CSS file to use to customize the wizard
     * appearance
     */

    'theme' => 'default',

    /**
     * -----------------------------------------------------------------------
     * Server Requirements
     * -----------------------------------------------------------------------
     *
     * This is the default Laravel server requirements, you can add as many
     * as your application require, we check if the extensions is enabled
     * by loading through the array and run "extension_loaded" on it.
     */
    'requirements' => [
        'php_version' => '5.5.9',
        'php_extensions' => [
            'mbstring',
            'openssl',
            'pdo',
            'tokenizer',
        ]
    ],

    /**
     * -----------------------------------------------------------------------
     * Folders Permissions
     * -----------------------------------------------------------------------
     *
     * This is the default Laravel folders permissions, if your application
     * requires more permissions just add them to the array list below.
     */
    'folder_permissions' => [
        'bootstrap/cache/' => '775',
        'storage/app/' => '775',
        'storage/framework/' => '775',
        'storage/logs/' => '775',
    ],
];