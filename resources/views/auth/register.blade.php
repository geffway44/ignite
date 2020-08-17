@extends('layouts.auth.base')

@section('content')
    <section class="py-16">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-7">
                    <div>
                        <a href="{{ url('/') }}" class="block h-10 mb-2">
                            <img class="h-10 w-auto" src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}" />
                        </a>

                        <h2 class="mt-6">
                            Let's get you started
                        </h2>

                        <h6 class="text-gray-600">
                            Already have an account? <a href="{{ route('login') }}">Sign in</a>
                        </h6>
                    </div>

                    <form class="mt-4" action="{{ route('register') }}" method="POST">
                        @csrf

                        <div>
                            <input type="hidden" name="type" value="company">
                        </div>

                        <div class="mt-4">
                            @include('components.forms.fields._name')
                        </div>

                        <div class="mt-4">
                            @include('components.forms.fields._email')
                        </div>

                        <div class="mt-4">
                            @include('components.forms.fields._new-password')
                        </div>

                        <div class="mt-4">
                            @include('components.forms.fields._confirm-password')
                        </div>

                        <div class="mt-4">
                            <p class="text-xs text-gray-600 max-w-sm">
                                By clicking Submit, you confirm you have read and agreed to <a href="/terms">{{ config('app.name') }} General Terms and Conditions</a> and <a href="/privacy">Privacy Policy</a>.
                            </p>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="btn btn-primary w-full">
                                Create your {{ config('app.name') }} account <span class="ml-1">&rarr;</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

