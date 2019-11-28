<div class="mb-4">
    <label for="employment" class="block uppercase font-semibold tracking-widest text-gray-700 text-xs mb-2 outline-none">{{ __('Place of Employment') }}</label>

    <input id="employment" type="text" class="form-input @error('employment') is-invalid @enderror" name="employment" value="{{ old('employment') ?? ($profile->employment ?? null) }}" autocomplete="employment" placeholder="Place of Employment">

    @error('employment')
        <span class="text-sm text-red-500 font-medium" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
