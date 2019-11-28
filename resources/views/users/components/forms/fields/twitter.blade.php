<div class="mb-4">
    <label for="twitter" class="block uppercase font-semibold tracking-widest text-gray-700 text-xs mb-2 outline-none">{{ __('Twitter Link') }}</label>

    <input id="twitter" type="text" class="form-input @error('twitter') is-invalid @enderror" name="twitter" value="{{ old('twitter') ?? ($profile->twitter ?? null) }}" autocomplete="twitter" placeholder="Twitter link">

    @error('twitter')
        <span class="text-sm text-red-500 font-medium" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
