<div class="mb-5 max-w-sm">
    <h3 class="text-2xl text-gray-800 font-bold">Security Settings</h3>

    <span class="text-gray-500">
        Remember to use unique usernames or email addresses when aupdating your account details.
    </span>
</div>

<form method="POST" action="{{ route('user.password.update', ['user' => $user->username]) }}" class="mb-20">
    @csrf

    <div class="mb-4">
        <label for="password" class="block uppercase font-semibold tracking-widest text-gray-500 text-xs mb-2 outline-none">{{ __('New Password') }}</label>

        <input id="password" type="text" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">

        <div class="block text-sm text-indigo-400 font-medium mt-1 mb-2" role="alert">
            Remember to use a minimum of 8 characters, 1 UPPERCASE and 1 non-alphanumeriç
        </div>

        @error('password')
            <span class="text-sm text-red-500 font-medium" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="mb-8">
        <label for="password-confirm" class="block uppercase font-semibold tracking-widest text-gray-500 text-xs mb-2 outline-none">{{ __('Confirm Password') }}</label>

        <input id="password-confirm" type="text" class="form-input @error('password-confirm') is-invalid @enderror" name="password-confirm" required autocomplete="new-password" placeholder="Confirm Password">
    </div>

    <div class="mb-4">
        <button type="submit" class="whitespace-no-wrap rounded-full bg-indigo-500 hover:bg-indigo-400 outline-none focus:outline-none px-8 py-4 leading-none text-white text-sm">
            {{ __('Reset Password') }}
        </button>
    </div>
</form>
