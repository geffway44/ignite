@extends('layouts.auth.base')

@section('content')
    <section class="py-16">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-7">
                    <div>
                        <a href="{{ url('/') }}" class="block h-6 w-auto">
                            <img class="h-6 w-auto" src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}" />
                        </a>

                        <h2 class="mt-6">
                            Welcome back
                        </h2>

                        <h6 class="text-gray-600">
                            Don't have an account yet? <a href="{{ route('register') }}">Sign up</a>
                        </h6>
                    </div>

                    <form class="mt-4" action="{{ route('login') }}" method="POST">
                        @csrf

                        <div>
                            @include('components.forms.fields._email')
                        </div>

                        <div class="mt-4">
                            @include('components.forms.fields._current-password')
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            @include('components.forms.fields._remember')

                            <div class="text-sm leading-5">
                                <a href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="btn btn-primary">
                                Sign in <span class="ml-1">&rarr;</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
