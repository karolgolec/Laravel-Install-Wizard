<?php

namespace KarGolSan\InstallWizard\Middleware;

use Closure;
use KarGolSan\InstallWizard\Triggers\TriggerHelper;

/**
 * Class InstallWizardTrigger
 *
 * @package KarGolSan\InstallWizard\Middleware
 */
class InstallWizardTrigger
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param string|null $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (TriggerHelper::shouldWizardBeTriggered()) return $this->redirectToWizard();

        return $next($request);
    }

    /**
     * Redirects to the wizard's first step
     */
    protected function redirectToWizard()
    {
        return redirect()->route('install_wizard.start');
    }
}