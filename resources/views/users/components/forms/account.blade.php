<div class="mb-5 max-w-sm">
    <h3 class="text-2xl text-gray-800 font-bold">Account Settings</h3>

    <span class="text-gray-500">
        Remember to use unique usernames or email addresses when aupdating your account details.
    </span>
</div>

<form method="POST" action="{{ route('user.update', ['user' => $user->username]) }}" class="mb-20">
    @csrf

    <div class="mb-4">
        <label for="name" class="block uppercase font-semibold tracking-widest text-gray-500 text-xs mb-2 outline-none">{{ __('Name') }}</label>

        <input id="name" type="text" class="form-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" required autocomplete="name" placeholder="Name">

        @error('name')
            <span class="text-sm text-red-500 font-medium" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="username" class="block uppercase font-semibold tracking-widest text-gray-500 text-xs mb-2 outline-none">{{ __('Username') }}</label>

        <input id="username" type="text" class="form-input @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? $user->username }}" required autocomplete="username" placeholder="Username">

        @error('username')
            <span class="text-sm text-red-500 font-medium" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="mb-8">
        <label for="email" class="block uppercase font-semibold tracking-widest text-gray-500 text-xs mb-2 outline-none">{{ __('Email') }}</label>

        <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}" required autocomplete="email" autofocus placeholder="Email">

        @error('email')
            <span class="text-sm text-red-500 font-medium" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="mb-4">
        <button type="submit" class="whitespace-no-wrap rounded-full bg-indigo-500 hover:bg-indigo-400 outline-none focus:outline-none px-8 py-4 leading-none text-white text-sm">
            {{ __('Save Changes') }}
        </button>
    </div>
</form>
