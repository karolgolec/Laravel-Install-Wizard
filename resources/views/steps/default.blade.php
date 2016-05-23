@extends('install_wizard::layouts.wizard')

@section('page.title')
    {{ trans('install_wizard::steps. ' . $currentStep->getID() . '.title') }}
@endsection

@section('wizard.header')
    <h1 class="iw-step-title">{!! trans('install_wizard::steps.' . $currentStep->getId() . '.title') !!}</h1>
@endsection

@section('wizard.breadcrumb')
    @include('install_wizard::partials.breadcrumb')
@endsection

@section('wizard.errors')
    @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
@endsection

@section('wizard.description')
    <h2>{!! trans('install_wizard::steps.' . $currentStep->getId() . '.description') !!}</h2>
@endsection
