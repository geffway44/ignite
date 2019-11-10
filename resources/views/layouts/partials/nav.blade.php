<nav class="navbar navbar-expand-md navbar-light bg-white border-b border-gray-200">
    <div class="container">
        <a class="navbar-brand" title="{{ config('app.name', 'Ignite') }}" href="{{ url('/home') }}">
            <div class="h-8 w-8 overflow-hidden">
                <img src="{{ asset('img/fire.png') }}" class="h-full" alt="{{ config('app.name', 'Ignite') }}">
            </div>
        </a>

        <button class="navbar-toggler border-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto items-center">
                {{--  --}}
            </ul>

            <ul class="navbar-nav mx-auto items-center">
                <li class="nav-item">
                    <a class="nav-link font-semibold" href="{{ url('/threads?following=1') }}">Feed</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link font-semibold" href="{{ url('/channels') }}">Discover</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link font-semibold" href="{{ url('/threads?popular=1') }}">Community</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto items-center">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="text-indigo-500 hover:text-indigo-400 font-medium" href="{{ route('login') }}">Get started <span>&rarr;</span></a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle -mr-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <div class="h-8 w-8 overflow-hidden">
                                <img class="w-full" src="{{ asset('img/avatars/default.svg') }}" alt="{{ auth()->user()->username }}">
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right border-none shadow-md rounded-lg px-3" aria-labelledby="navbarDropdown">
                            <div class="px-3 pb-1">
                                <span class="text-xs text-gray-500">Welcome,</span>
                                <h6 class="font-semibold text-base">{{ auth()->user()->name }}</h6>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('user.show', ['user' => auth()->user()->username]) }}" class="dropdown-item rounded-lg">Profile</a>
                            <a href="{{ url('/threads?by=' . auth()->user()->username) }}" class="dropdown-item rounded-lg">Questions</a>
                            <a href="{{ route('user.show', ['user' => auth()->user()->username]) }}" class="dropdown-item rounded-lg">Activities</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('user.edit', ['user' => auth()->user()->username]) }}" class="dropdown-item rounded-lg">Settings</a>
                            <a href="{{ url('/help') }}" class="dropdown-item rounded-lg">Support</a>
                            <a class="dropdown-item rounded-lg" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Sign out') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
