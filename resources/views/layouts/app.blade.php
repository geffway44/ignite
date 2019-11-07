<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta Data -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="{{ config('app.description', 'Ignite') }}">

    @stack('meta')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Site Title -->
    <title>{{ config('app.name', 'Ignite') }}</title>

    <link rel="home" href="{{ config('app.url') }}">
    <link rel="icon" href="/favicon.ico">

    <!-- Styles -->
    @include('layouts.partials.css')
</head>
<body class="leading-normal text-gray-700 font-sans">
    <div id="app">
        <!-- Header -->
        <header>
            @include('layouts.partials.header')
        </header>

        <!-- Main Content -->
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        @yield('content')
                    </div>

                    <div class="col-lg-3 offset-lg-1 md:flex hidden">
                        @yield('sidebar')
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer>
            @include('layouts.partials.footer')
        </footer>

        <!-- Modals -->
        @yield('modals')
    </div>

    <!-- Scripts -->
    @include('layouts.partials.js')
</body>
</html>
