<?php

namespace KarGolSan\InstallWizard\Steps;

use Exception;

class DatabaseStep extends BaseStep
{

    public function __construct($id)
    {
        parent::__construct($id);
    }

    /**
     * @param array $formData An array containing all the form data for that step
     *
     * @return boolean true if the step has been applied successfully
     */
    function apply($formData)
    {
        try {
            if ($this->isChecked($formData, 'refresh_db')){
                \Artisan::call('migrate:refresh');
            } else {
                \Artisan::call('migrate');
            }
            
            if ($this->isChecked($formData, 'enable_seeding')) {
                \Artisan::call('db:seed');
            }
        } catch (Exception $e) {
            $this->addError('exception', $e->getMessage());
            
            return false;
        }
        
        return true;
    }

    /**
     * @return boolean true if the steps has been undone successfully
     */
    function undo()
    {
        try {
            \Artisan::call('migrate:rollback');
        } catch (Exception $e) {
            $this->addError('exception', $e->getMessage());
            
            return false;
        }
        
        return true;
    }

    protected function isChecked($formData, $optionName){
        return isset($formData[$optionName]) && $formData[$optionName] == 1;
    }
    {
        
    }
}