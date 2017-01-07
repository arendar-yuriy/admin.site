<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Please, login!</title>

    @include('auth.styles')

    @include('auth.scripts')

    <script>
        $(document).ready(function(){
            {!! @$onLoad !!}
        });
    </script>

</head>

<body class="bg-slate-800  pace-done">

    <div class="page-container login-container">

        <div class="page-content">

            <div class="content-wrapper">

                <div class="content">

                    @yield('form')

                </div>

            </div>

        </div>

    </div>

</body>
</html>
