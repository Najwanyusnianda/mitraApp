<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <!--<link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
     Generated: 2019-04-04 16:55:45 +0200 -->
    <title>mitraApp</title>
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
    <link href="{{ asset('assets/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/tabler/css/dashboard.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/tabler/js/dashboard.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('assets/tabler/js/vendors/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('assets/tabler/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('assets/tabler/js/core.js') }}"></script>

    @livewireStyles
</head>

<body>
    <div class="page">
        <div class="flex-fill">
@include('master_navbar')
          <div class="my-3 my-md-5">
            <div class="container">
              @yield('content')
            </div>
          </div>
        </div>
@include('master_footer')
      </div>
      @livewireScripts
      <script type="text/javascript" src="{{ asset('assets/flatpickr/flatpickr.js') }}" ></script>
</body>

</html>