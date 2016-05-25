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
    <link rel="stylesheet" href="{{ asset('vendor/install_wizard/css/' . config('install_wizard.theme') . '.css') }}">
</head>
<body>
    <div class="container">
        <div class="row ">
            <div class="iw-default_title">
                @yield('wizard.header')
            </div>
            <div class="iw-breadcrumb">
                @yield('wizard.breadcrumb')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! Form::open([
                    'route' => ['install_wizard.submit', $currentStep->getSlug()],
                    'files' => true,
                ]) !!}
                <div>
                    <div class="iw-step-title_step">
                        @yield('wizard.title_step')
                    </div>

                    <div class="iw-description">
                        @yield('wizard.description')
                    </div>

                    <div class="iw-errors">
                        @yield('wizard.errors')
                    </div>

                    <div class="iw-step-form">
                        @yield('wizard.form')
                    </div>

                    <div class="iw-navigation">
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