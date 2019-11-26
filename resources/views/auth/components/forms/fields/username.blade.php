<div class="mb-4">
    <label for="username" class="block uppercase font-semibold tracking-widest text-gray-700 text-xs mb-2 outline-none">{{ __('Username') }}</label>

    <input id="username" type="text" class="form-input @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? ($user->username ?? null) }}" required autocomplete="username" placeholder="Username">

    @error('username')
        <span class="text-sm text-red-500 font-medium" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
