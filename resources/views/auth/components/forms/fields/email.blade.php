<div class="mb-4">
    <label for="email" class="block uppercase font-semibold tracking-widest text-gray-700 text-xs mb-2 outline-none">{{ __('Email') }}</label>

    <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? ($user->email ?? null) }}" required autocomplete="email" placeholder="Email">

    @error('email')
        <span class="text-sm text-red-500 font-medium" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
