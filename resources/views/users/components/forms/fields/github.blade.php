<div class="mb-4">
    <label for="github" class="block uppercase font-semibold tracking-widest text-gray-700 text-xs mb-2 outline-none">{{ __('Github Link') }}</label>

    <input id="github" type="text" class="form-input @error('github') is-invalid @enderror" name="github" value="{{ old('github') ?? ($profile->github ?? null) }}" autocomplete="github" placeholder="Github link">

    @error('github')
        <span class="text-sm text-red-500 font-medium" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
