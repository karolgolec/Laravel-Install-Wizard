<?php

namespace KarGolSan\InstallWizard\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use KarGolSan\InstallWizard\Exceptions\StepNotFoundException;
use KarGolSan\InstallWizard\Facades\InstallWizard;

class WizardController extends Controller
{
    /** @var  InstallWizard */
    protected $wizard;

    /**
     * WizardController constructor.
     *
     * @param InstallWizard $wizard
     */
    public function __construct(InstallWizard $wizard)
    {
        $this->wizard = $wizard;

        // Our methods all use the middleware to setup the wizard (find current step, etc.)
        $this->middleware(['install_wizard']);
    }

    /**
     * Show the form to install the current step
     *
     * @return Response
     */
    public function showStep()
    {
        return view()->make('install_wizard::steps.default');
    }

    /**
     * Submit the wizard step currently shown with the specified action (next/back)
     *
     * @param Request $request
     *
     * @return Response
     */
    public function submitStep(Request $request)
    {
        if ($request->has('wizard-action-next')) {
            return $this->nextStep($request);
        }

        if ($request->has('wizard-action-back')){
            return $this->previousStep($request);
        }

        throw new \RuntimeException('Unknown wizard action');
    }

    /**
     * Apply current step and move on to next step
     *
     * @param Request $request
     *
     * @return Response
     */
    protected function nextStep(Request $request)
    {
        // Apply the current step. If success, we can redirect to next one
        $currentStep = \InstallWizard::currentStep();
        if (!$currentStep->apply($request->all())) {
            return view()->make('install_wizard::steps.default', ['errors' => $currentStep->getMessageBag()]);
        }

        // If we have a next step, go for it. Else we redirect to somewhere else
        try {
            $nextStep = \InstallWizard::nextStep();

            return redirect()->route('install_wizard.show', ['slug' => $nextStep->getSlug()]);
        } catch (StepNotFoundException $e) {
            $finalRouteName = config('install_wizard.routing.success_route'. '');
            if (!empty($finalRouteName)) return redirect()->route($finalRouteName);

            $finalRouteUrl = config('install_wizard.routing.success_url', '');
            if (!empty($finalRouteUrl)) return redirect()->to($finalRouteUrl);

            return redirect('/');
        }

    }

    protected function previousStep(Request $request)
    {
        try {
            // Undo the previous step. If success, we can redirect to its form
            $previousSetp = \InstallWizard::previousStep();
            if (!$previousSetp->undo()){
                return view()->make('install_wizard::steps.default', ['errors' => $previousSetp->getMessageBag()]);
            }

            return redirect()->route('install_wizard.show', ['slug' => $previousSetp->getSlug()]);
        } catch (StepNotFoundException $e) {
            return redirect()->route('install_wizard.show');
        }
    }

}