<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ignite') }} | Forum</title>

    @include('layouts.partials.css')
</head>
<body class="leading-normal text-gray-700">
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @include('layouts.partials.js')
</body>
</html>
