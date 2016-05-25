@unless (InstallWizard::isFirst())
    {{ Form::submit(trans('install_wizard::views.nav.back'), [
        'name' => 'wizard-action-back',
        'class' => 'btn btn-default btn-back',
    ]) }}
@endunless

@if (InstallWizard::isLast())
    {{ Form::submit(trans('install_wizard::views.nav.done'), [
        'name' => 'wizard-action-next',
        'class' => 'btn btn-primary',
    ]) }}
@else
    {{ Form::submit(trans('install_wizard::views.nav.next'), [
        'name' => 'wizard-action-next',
        'class' => 'btn btn-primary',
    ]) }}
@endif
