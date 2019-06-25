<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Bootstrap Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" width="32px;" height="32px" href="{{ url('images/logo.svg') }}">
    <title>{{env('APP_NAME')}}</title>

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('style')
</head>

<body>

    @include('components.navigation')

    <div class="container">
        @yield('body')
    </div>

    <!-- JS -->
    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
    $(document).ready( function() {

    });
    </script>

    @yield('script')

</body>

</html>
