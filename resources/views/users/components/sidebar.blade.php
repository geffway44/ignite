<section class="py-12">
    <div class="mb-4">
        <h2 class="text-2xl text-gray-800 font-bold m-0">Profile Links</h2>

        <span class="text-gray-500">
            To make it easy for you to navigate around your profile.
        </span>
    </div>

    <ul class="unstyled mb-10">
        <li class="block py-3">
            <a href="{{ route('user.show', ['user' => $user->username]) }}" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium">
                Profile
            </a>
        </li>

        <li class="block py-3">
            <a href="/threads?popular=1" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium">
                Activity
            </a>
        </li>

        <li class="block py-3">
            <a href="/threads?by={{ auth()->user()->username }}" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium">
                My Threads
            </a>
        </li>

        <li class="block py-3">
            <a href="{{ route('user.edit', ['user' => $user->username]) }}" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium">
                Settings
            </a>
        </li>

        <li class="block py-3">
            <a href="{{ route('logout') }}" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Sign out
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</section>
