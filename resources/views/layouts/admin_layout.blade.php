<!DOCTYPE html>
<html lang="en" data-theme="dark" style="color-scheme: dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.26.0/tabler-icons.min.css"
        integrity="sha512-k9iJhTcDc/0fp2XLBweIJjHuQasnXicVPXbUG0hr5bB0/JqoTYEFeCdQj4aJTg50Gw6rBJiHfWJ8Y+AeF1Pd3A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" href="{{ asset('favicon-dark.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('favicon-light.png') }}" />
    <link href="{{ asset('assets/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/demo.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    @yield('style_top')
    @yield('style_bottom')
</head>

<body>
    <div class="page">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <div class="page-wrapper">
            <!-- Page header -->
            @include('layouts.header')

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    @section('content')
                    @show
                </div>
            </div>

        </div>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('assets/js/demo-theme.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/jsvectormap/dist/js/jsvectormap.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/jsvectormap/dist/maps/world.js') }}" defer></script>
    <script src="{{ asset('assets/libs/jsvectormap/dist/maps/world-merc.js') }}" defer></script>
    <!-- Tabler Core -->
    <script src="{{ asset('assets/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/demo.min.js') }}" defer></script>

    @yield('script_top')
    @yield('script_bottom')
</body>

</html>
