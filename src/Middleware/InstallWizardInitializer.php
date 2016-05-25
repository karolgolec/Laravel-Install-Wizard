<?php

namespace KarGolSan\InstallWizard\Middleware;

use Closure;
use KarGolSan\InstallWizard\Triggers\TriggerHelper;

/**
 * Class InstallWizardInitializer
 *
 * @package KarGoleSan\InstallWizard\Middleware
 */
class InstallWizardInitializer
{
    /**
     * Handle an incoming request
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param string|null $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Send a forbidden status if wizard should not be triggered
        if (TriggerHelper::hasWizardCompleted()) return $this->forbiddenResponse();

        // Get the current step from the route slug
        $currentStepSlug = $request->route()->getParameter('slug', '');
        \InstallWizard::initialize($currentStepSlug);

        // Share common data with our views
        view()->share('currentStep', \InstallWizard::currentStep());
        view()->share('allSteps', \InstallWizard::steps());

        // Proceed as usual
        return $next($request);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function forbiddenResponse()
    {
        return response('Forbidden', 403);
    }
}
