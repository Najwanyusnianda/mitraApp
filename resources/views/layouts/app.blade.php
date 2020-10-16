<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIBERAS') }}</title>

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <link href="{{ asset('assets/fontawesome/css/all.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <!--<script src="{{ asset('assets/tabler/js/require.min.js') }}"></script>

    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>-->
    <!-- Dashboard Core -->
    <link href="{{ asset('assets/tabler/css/dashboard.css') }}" rel="stylesheet" />

    <script src="{{ asset('assets/tabler/js/dashboard.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('assets/tabler/js/vendors/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('assets/tabler/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('assets/tabler/js/core.js') }}"></script>

</head>
<body>
    <div id="app">


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
