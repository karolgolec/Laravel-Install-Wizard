<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ trans('install_wizard::views.default_title') }} &raquo @yield('page.title')</title>

    <!-- Styles (using Bootstrap as default -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/install_wizard/css/' . config('install_wizard.theme') . '.css') }}"
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-push-1 col-lg-8 col-lg-push-2">
            {!! Form::open([
                'route' => ['install_wizard.submit', $currentStep->getSlug()],
                'files' => true,
            ]) !!}

            <div class="iw-wizard">
                <div class="iw-step-header">
                    @yield('wizard.header')
                </div>

                <div class="iw-step-breadcrumb">
                    @yield('wizard.breadcrumb')
                </div>

                <div class="iw-step-description">
                    @yield('wizard.header')
                </div>

                <div class="iw-step-errors">
                    @yield('wizard.errors')
                </div>

                <div class="iw-step-form">
                    @yield('wizard.form')
                </div>

                <div class="iw-step-navigation">
                    @yield('wizard.navigation')
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- jQuery first, then Bootstrap JS. -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"></script>
</body>
</html>