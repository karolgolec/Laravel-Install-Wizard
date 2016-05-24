<?php

namespace KarGolSan\InstallWizard\Wizard;

use Illuminate\Contracts\Foundation\Application;
use KarGolSan\InstallWizard\Contracts\InstallWizard;
use KarGolSan\InstallWizard\Contracts\WizardStep;
use KarGolSan\InstallWizard\Exceptions\StepNotFoundException;

class DefaultInstallWizard implements InstallWizard
{
    /** @var  Application the Laravel application instance. */
    protected $app;
    
    /** @var array The steps of the wizard */
    protected $steps = null;
    
    /** @var WizardStep The step currently displayed to the user */
    protected $currentStep = null;
    
    /** @var int The index of the current step */
    protected $currentStepIndex = -1;

    /**
     * @param Application $app
     */
    public function __construct($app = null){
        if (!app) {
            $app = app();   //Fallback when $app is not given
        }
        $this->app = $app;
    }
    /**
     * Initialize the wizard for the current request. Sets the current step, etc.
     *
     * @param $currentStepSlug
     */
    function initialize($currentStepSlug)
    {
        try {
            $this->currentStep = $this->findStepBySlug($currentStepSlug);
            $this->currentStepIndex = $this->stepIndex($this->currentStep->getId());
        } catch (StepNotFoundException $e) {
            $this->currentStep = $this->firstStep();
            $this->currentStepIndex = 0;
        }
    }

    /**
     * Get the steps which
     *
     * @return array The step objects
     */
    function steps()
    {
        if ($this->steps = null) {
            $this->steps = $this->createStepsFromConfig();
        }
        
        return $this->steps;
    }

    /**
     * @return WizardStep The first step of the wizard
     */
    function firstStep()
    {
        $steps = $this->steps();
        
        return reset($steps);
    }

    /**
     *
     * @param string $stepId The ID of the step
     *
     * @return int The step order number (0 is the first step)
     * @throws StepNotFoundException If no step with that ID is found
     */
    function stepIndex($stepId)
    {
        $steps = $this->steps();
        $i = 0;

        foreach ($steps as $id => $step) {
            if ($id == $stepId) return $i;
            ++$i;
        }
        throw new StepNotFoundException();
    }

    /**
     * @return WizardStep The current step
     */
    function currentStep()
    {
        return $this->currentStep;
    }

    /**
     * @return WizardStep The previous step
     */
    function previousStep()
    {
        return $this->findStepByIndex($this->currentStepIndex - 1);
    }

    /**
     * @return WizardStep The next step
     */
    function nextStep()
    {
        return $this->findStepByIndex($this->currentStepIndex + 1);
    }

    /**
     * @return int Percentage of progress for the wizard, given the current step
     */
    function progress()
    {
        return 100 * $this->currentStepIndex / count($this->steps());
    }

    /**
     * Check if the step ID corresponds to the current step
     *
     * @param string $stepId The ID of the step
     *
     * @return bool true if the step is the current one
     */
    function isCurrent($stepId)
    {
        return $this->currentStep()->getId() == $stepId;
    }

    /**
     * If the step the first one of the wizard
     *
     * @param string $stepId The ID of the step, or null to target the current step
     *
     * @return bool true if the step is the first
     * @throws StepNotFoundException If no step with that ID is found
     */
    function isFirst($stepId = null)
    {
        $i = $this->stepIndex($stepId == null ? $this->currentStep->getId() : $stepId);

        return $i == 0;
    }

    /**
     * If the step the last one of the wizard
     *
     * @param string $stepId The ID of the step, or null to target the current step
     *
     * @return bool true if the step is the last
     * @throws StepNotFoundException If no step with that ID is found
     */
    function isLast($stepId = null)
    {
        $i = $this->stepIndex($stepId == null ? $this->currentStep->getId() : $stepId);

        return $i == count($this->steps()) - 1;
    }

    /**
     * Get configuration and create the step objects
     * 
     * @return array The step object, indexed by ID
     */
    protected function createStepsFromConfig()
    {
        $config = $this->app['config'];
        $stepClasses = $config->get('install_wizard.steps');
        
        if (empty($stepClasses)) throw new \RuntimeException('The install wizard requires at least 1 step in configuration');
        
        $steps = [];
        $i = 0;
        foreach ($stepClasses as $id => $stepClass) {
            $s = new $stepClass($id);
            $steps[$id] = $s;
            ++$i;
        }
        
        return $steps;
    }

    protected function findStepByIndex($index)
    {
        /** @var array $steps */
        $steps = $this->steps();
        
        if ($index < 0 || $index >= count($steps)) throw new StepNotFoundException();
        
        /** @var WizardStep $step */
        $i = 0;
        foreach ($steps as $id => $step)
        {
            if ($i == $index) return $step;
            ++$i;
        }
        
        throw new StepNotFoundException;
    }

    protected function findStepBySlug($slug = '')
    {
        /** @var array $steps */
        $steps = $this->steps();
        
        foreach ($steps as $id => $step) {
            if ($step->getSlug() == $slug) return $step;
        }
        
        throw new StepNotFoundException();
    }
}