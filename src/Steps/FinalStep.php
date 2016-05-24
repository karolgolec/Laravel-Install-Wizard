<?php

namespace KarGolSan\InstallWizard\Steps;

class FinalStep extends BaseStep
{

    public function __construct($id)
    {
        parent::__construct($id);
    }

    public function apply($formData)
    {
        // Create a file which means the wizard is completed
        $filePath = storage_path('.install_wizard');
        $installData = json_encode([
            'completed' => true,
            'version' => '0.0.0',
        ], JSON_PRETTY_PRINT);

        if (false === file_put_contents($filePath, $installData)) {
            $this->addError('cannot_write_file', trans('install_wizard::steps.final.errors.cannot_write_file'));

            return false;
        }

        return true;
    }

    public function undo()
    {
        return true;
    }
}