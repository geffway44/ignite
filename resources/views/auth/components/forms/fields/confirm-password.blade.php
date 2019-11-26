<div class="mb-8">
    <label for="password-confirm" class="block uppercase font-semibold tracking-widest text-gray-700 text-xs mb-2 outline-none">{{ __('Confirm Password') }}</label>

    <input id="password-confirm" type="password" class="form-input @error('password-confirm') is-invalid @enderror" name="password-confirm" required autocomplete="new-password" placeholder="Confirm Password">
</div>
