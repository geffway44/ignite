<div class="mb-5 max-w-sm">
    <h3 class="text-2xl text-gray-800 font-bold">Account Settings</h3>

    <span class="text-gray-500">
        Remember to use unique usernames or email addresses when aupdating your account details.
    </span>
</div>

<form method="POST" action="{{ route('user.update', ['user' => $user->username]) }}" class="mb-20">
    @csrf
    @method('PUT')

    @include('auth.components.forms.fields.name', ['user' => $user])

    @include('auth.components.forms.fields.username', ['user' => $user])

    @include('auth.components.forms.fields.email', ['user' => $user])

    <div class="mb-4 mt-8">
        <button type="submit" class="whitespace-no-wrap rounded-full bg-indigo-500 hover:bg-indigo-400 outline-none focus:outline-none px-8 py-4 leading-none text-white text-sm">
            {{ __('Save Changes') }}
        </button>
    </div>
</form>
