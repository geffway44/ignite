<div class="mb-4">
    <label for="password" class="block uppercase font-semibold tracking-widest text-gray-700 text-xs mb-2 outline-none">{{ __('Password') }}</label>

    <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

    @error('password')
        <span class="text-sm text-red-500 font-medium" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
