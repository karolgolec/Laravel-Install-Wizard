<?php

/** @var \Config $config */

Route::group([
    'prefix' => $config->get('install_wizard.routing.prefix')
], function() {
    
    // Show the first step of the wizard
    Route::get('/', [
        'as' => 'install_wizard.start',
        'uses' => 'KarGolSan\InstallWizard\Controllers\WizardController@showStep'
    ]);
    
    // Show a step for a wizard
    Route::get('{slug?}', [
        'as' => 'install_wizard.show',
        'uses' => 'KarGolSan\InstallWizard\Controllers\WizardController@showStep'
    ])->where('slug', '([a-zA-Z0-9\-])*');
    
    // Submit a step for a wizard
    Route::post('{slug?}', [
        'as' => 'install_wizard.submit',
        'uses' => 'KarGolSan\InstallWizard\Controllers\WizardController@submitStep'
    ])->where('slug', '([a-zA-Z0-9\-])*');
});