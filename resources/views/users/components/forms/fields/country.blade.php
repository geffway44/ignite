<div class="mb-4">
    <label for="country" class="block uppercase font-semibold tracking-widest text-gray-700 text-xs mb-2 outline-none">{{ __('Country') }}</label>

    <input id="country" type="text" class="form-input @error('country') is-invalid @enderror" name="country" value="{{ old('country') ?? ($profile->country ?? null) }}" autocomplete="country" placeholder="Country">

    @error('country')
        <span class="text-sm text-red-500 font-medium" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
