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
        <main class="py-4 min-h-screen">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 py-24">
                        <div>
                            <h1 class="text-4xl mb-5 font-semibold">
                                Ignite a conversation with people and grow your network.
                            </h1>

                            <p class="text-gray-500 text-xl">
                                Quae vero auctorem tractata ab fiducia dicuntur. Idque Caesaris facere voluntate liceret: sese habere.
                            </p>

                            <div class="mt-8">
                                <a href="{{ route('threads.create') }}" class="inline-block whitespace-no-wrap rounded-full bg-indigo-500 hover:bg-indigo-400 outline-none focus:outline-none px-8 py-4 leading-none text-white text-sm">Get started <span>&rarr;</span></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 py-24">
                        <div class="overflow-hidden pl-12">
                            <img class="w-full" src="{{ asset('img/convo.svg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer>
            @include('layouts.partials.footer')
        </footer>
    </div>

    <!-- Scripts -->
    @include('layouts.partials.js')
</body>
</html>
