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

                        <div class="mb-4">
                            <label for="name" class="block uppercase font-semibold tracking-widest text-gray-500 text-xs mb-2 outline-none">{{ __('Name') }}</label>

                            <input id="name" type="text" class="form-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                            @error('name')
                                <span class="text-sm text-red-500 font-medium" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="username" class="block uppercase font-semibold tracking-widest text-gray-500 text-xs mb-2 outline-none">{{ __('Username') }}</label>

                            <input id="username" type="text" class="form-input @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">

                            @error('username')
                                <span class="text-sm text-red-500 font-medium" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block uppercase font-semibold tracking-widest text-gray-500 text-xs mb-2 outline-none">{{ __('Email') }}</label>

                            <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                            @error('email')
                                <span class="text-sm text-red-500 font-medium" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block uppercase font-semibold tracking-widest text-gray-500 text-xs mb-2 outline-none">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                        </div>

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

