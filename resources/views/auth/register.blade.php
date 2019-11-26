@extends('layouts.auth')

@section('content')
<section id="login-section" class="py-24">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div>
                    <div class="mb-4">
                        <h4 class="text-4xl mb-2">
                            Sign up
                        </h4>

                        <p class="mb-0 text-gray-500 leading-relaxed max-w-xs">
                            Welcome to <span class="font-bold">{{ config('app.name') }}</span>. Your personal finance management assistant.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        @include('auth.components.forms.fields.name')

                        @include('auth.components.forms.fields.username')

                        @include('auth.components.forms.fields.email')

                        @include('auth.components.forms.fields.new-password')

                        <div class="mb-4">
                            <div class="form-check mb-4">
                                <p class="text-sm text-gray-500 max-w-sm">
                                    By signing up, you confirm that you’ve read and accepted our User Notice and Privacy Policy.
                                </p>
                            </div>

                            <button type="submit" class="whitespace-no-wrap rounded-full bg-indigo-500 hover:bg-indigo-400 outline-none focus:outline-none px-8 py-4 leading-none text-white text-sm">
                                {{ __('Create Account') }} <span class="ml-1">&#8594;</span>
                            </button>
                        </div>
                    </form>

                    <div class="mt-4 text-sm">
                        <span>
                            <span class="text-gray-500">Already have an account?</span> <a class="text-indigo-500 hover:text-indigo-400" href="{{ route('login') }}">Sign in</a>.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

