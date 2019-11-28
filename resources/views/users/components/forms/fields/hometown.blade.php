<div class="mb-4">
    <label for="homwtown" class="block uppercase font-semibold tracking-widest text-gray-700 text-xs mb-2 outline-none">{{ __('Hometown') }}</label>

    <input id="homwtown" type="text" class="form-input @error('homwtown') is-invalid @enderror" name="homwtown" value="{{ old('homwtown') ?? ($profile->homwtown ?? null) }}" autocomplete="homwtown" placeholder="Hometown">

    @error('homwtown')
        <span class="text-sm text-red-500 font-medium" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
