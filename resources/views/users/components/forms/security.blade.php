<div class="mb-5 max-w-sm">
    <h3 class="text-2xl text-gray-800 font-bold">Security Settings</h3>

    <span class="text-gray-500">
        Remember to use a minimum of 8 characters, 1 UPPERCASE and 1 non-alphanumeriç
    </span>
</div>

<form method="POST" action="{{ route('user.password.update', ['user' => $user->username]) }}" class="mb-20">
    @csrf
    @method('PUT')

    @include('auth.components.forms.fields.new-password')

    @include('auth.components.forms.fields.confirm-password')

    <div class="mb-4">
        <button type="submit" class="whitespace-no-wrap rounded-full bg-indigo-500 hover:bg-indigo-400 outline-none focus:outline-none px-8 py-4 leading-none text-white text-sm">
            {{ __('Reset Password') }}
        </button>
    </div>
</form>
