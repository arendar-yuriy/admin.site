<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title}}</title>

    @include('layout.default.styles')

    @include('layout.default.scripts')


</head>

<body class="navbar-top @if($controller == 'product') sidebar-xs @endif pace-done has-detached-right">

    @include('layout.default.inc.modals')

    @include('layout.default.inc.navbar')

    <div class="page-container">

        <div class="page-content">

            @include('layout.default.inc.sidebar')

            <div class="content-wrapper">


                @include('layout.default.inc.page_header')

                <div class="content">

                    @yield('content')

                    @include('layout.default.footer')

                </div>

            </div>

        </div>

    </div>

</body>
</html>
