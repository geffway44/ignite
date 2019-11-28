<div class="mb-4">
    <label for="job" class="block uppercase font-semibold tracking-widest text-gray-700 text-xs mb-2 outline-none">{{ __('Job Title') }}</label>

    <input id="job" type="text" class="form-input @error('job') is-invalid @enderror" name="job" value="{{ old('job') ?? ($profile->job ?? null) }}" autocomplete="job" placeholder="Job Title">

    @error('job')
        <span class="text-sm text-red-500 font-medium" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
