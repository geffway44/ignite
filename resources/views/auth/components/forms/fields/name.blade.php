<div class="mb-4">
    <label for="name" class="block uppercase font-semibold tracking-widest text-gray-700 text-xs mb-2 outline-none">{{ __('Name') }}</label>

    <input id="name" type="text" class="form-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? ($user->name ?? null) }}" required autocomplete="name" autofocus placeholder="Name">

    @error('name')
        <span class="text-sm text-red-500 font-medium" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
