<div class="mb-5 max-w-sm">
    <h3 class="text-2xl text-gray-800 font-bold">Profile Settings</h3>

    <span class="text-gray-500">
        Update your personal details and what other people see about you.
    </span>
</div>

<form method="POST" action="{{ route('user.profile.update', ['user' => $user->username]) }}" class="mb-20">
    @csrf
    @method('PUT')

    @include('users.components.forms.fields.website', ['profile' => $profile])

    @include('users.components.forms.fields.github', ['profile' => $profile])

    @include('users.components.forms.fields.twitter', ['profile' => $profile])

    @include('users.components.forms.fields.job', ['profile' => $profile])

    @include('users.components.forms.fields.employment', ['profile' => $profile])

    @include('users.components.forms.fields.hometown', ['profile' => $profile])

    @include('users.components.forms.fields.country', ['profile' => $profile])

    <div class="mb-4 mt-8">
        <button type="submit" class="whitespace-no-wrap rounded-full bg-indigo-500 hover:bg-indigo-400 outline-none focus:outline-none px-8 py-4 leading-none text-white text-sm">
            {{ __('Save Changes') }}
        </button>
    </div>
</form>
