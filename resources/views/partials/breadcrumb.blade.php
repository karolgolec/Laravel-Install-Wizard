<ol>
    @php($isCurrent = true)
    @foreach($allSteps as $id => $step)
        @php($cssClass = ($isCurrent ? 'iw-current' : ''))

        <li class="iw-step-divider {{ $cssClass }}"></li>
        <li class="iw-step" {{ $cssClass }}">{!! trans('install_wizard::steps.' . $id . '.breadcrumb') !!}</li>

        @if(\InstallWizard::isCurrent($id))
            @php($isCurrent = false)
        @endif
    @endforeach

    <li class="iw-step-divider"></li>
</ol>