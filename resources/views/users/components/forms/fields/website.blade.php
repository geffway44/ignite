<div class="mb-4">
    <label for="website" class="block uppercase font-semibold tracking-widest text-gray-700 text-xs mb-2 outline-none">{{ __('Website') }}</label>

    <input id="website" type="text" class="form-input @error('website') is-invalid @enderror" name="website" value="{{ old('website') ?? ($profile->website ?? null) }}" autocomplete="website" placeholder="Website">

    @error('website')
        <span class="text-sm text-red-500 font-medium" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
