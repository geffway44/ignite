@extends('layouts.auth.base')

@section('content')
    <section class="py-16">
        <div class="container">
            <div class="row justify-center">
                <div class="col-xl-4 col-lg-5 col-md-7 col-sm-8">
                    <div class="text-center">
                        <a href="{{ url('/') }}" class="block h-6 w-auto text-center">
                            <img class="h-6 w-auto inline-block" src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}" />
                        </a>

                        <h2 class="mt-6">
                            Reset password
                        </h2>

                        <h6 class="text-gray-600">
                            Enter the email address associated with your account and we'll send you a link to reset your password.
                        </h6>
                    </div>

                    <form class="mt-4" action="{{ route('password.email') }}" method="POST">
                        @csrf

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @include('components.forms.fields._email')

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-full">
                                Request password reset link <span class="ml-1">&rarr;</span>
                            </button>
                        </div>

                        <div class="mt-6 text-center">
                            <span class="text-sm text-gray-600">
                                Just remembered your password? <a href="{{ route('login') }}">Sign in</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
