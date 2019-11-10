@extends('layouts.auth')

@section('content')
<section id="login-section" class="py-24">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div>
                    <div class="mb-4">
                        <h4 class="text-4xl mb-2">
                            Sign in
                        </h4>

                        <p class="mb-0 text-gray-500 leading-relaxed max-w-xs">
                            Please sign in to see latest updates on your project.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="block uppercase font-semibold tracking-widest text-gray-700 text-xs mb-2 outline-none">{{ __('Email') }}</label>

                            <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                            @error('email')
                                <span class="text-sm text-red-500 font-medium" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block uppercase font-semibold tracking-widest text-gray-700 text-xs mb-2 outline-none">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                            <div class="mt-2">
                                @error('password')
                                    <span class="text-sm text-red-500 font-medium" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror

                                <div class="text-right">
                                    @if (Route::has('password.request'))
                                        <a class="text-indigo-500 hover:text-indigo-400 text-sm" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="my-4">
                            <label class="flex items-center mb-8">
                                <input type="checkbox" class="form-checkbox text-indigo-500" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <span class="ml-2 text-gray-500 text-sm">{{ __('Keep me signed in') }}</span>
                            </label>

                            <button type="submit" class="whitespace-no-wrap rounded-full bg-indigo-500 hover:bg-indigo-400 outline-none focus:outline-none px-8 py-4 leading-none text-white text-sm">
                                {{ __('Sign In') }} <span class="ml-1">&#8594;</span>
                            </button>
                        </div>
                    </form>

                    @if (Route::has('register'))
                        <div class="mt-4 text-sm">
                            <span>
                                <span class="text-gray-500">Don't have an account yet?</span> <a class="text-indigo-500 hover:text-indigo-400" href="{{ route('register') }}">Sign up</a>.
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
