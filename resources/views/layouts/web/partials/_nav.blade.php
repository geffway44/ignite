<nav class="h-16 flex items-center {{ $bgNav ?? 'bg-white' }} border-b border-gray-200">
    <div class="flex-1 container">
        <div class="flex justify-between items-center">
            <a class="block h-6 w-auto" href="/" title="{{ config('app.name') }}">
                <img class="h-6 w-auto" src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}">
            </a>

            <div class="ml-10 hidden md:flex flex-1 items-center justify-between">
                <ul class="flex items-center">
                    <li>
                        <a class="text-sm font-semibold text-gray-700 hover:text-blue-500 focus:text-blue-500 active:text-blue-500" href="/threads">{{ __('Browse') }}</a>
                    </li>

                    <li class="ml-6">
                        <a class="text-sm font-semibold text-gray-700 hover:text-blue-500 focus:text-blue-500 active:text-blue-500" href="/threads?popular=1">{{ __('Popular') }}</a>
                    </li>

                    <li class="ml-6">
                        <a class="text-sm font-semibold text-gray-700 hover:text-blue-500 focus:text-blue-500 active:text-blue-500" href="//threads?featured=1">{{ __('Featured') }}</a>
                    </li>

                    <li class="ml-6">
                        <a class="text-sm font-semibold text-gray-700 hover:text-blue-500 focus:text-blue-500 active:text-blue-500" href="//threads?recent=1">{{ __('Recent') }}</a>
                    </li>

                    <li class="ml-6">
                        <a class="text-sm font-semibold text-gray-700 hover:text-blue-500 focus:text-blue-500 active:text-blue-500" href="//threads?unanswered=1">{{ __('Unanswered') }}</a>
                    </li>
                </ul>

                <ul class="flex items-center">
                    @auth
                        <li class="ml-6">
                            <a class="text-sm font-semibold text-blue-500 hover:text-blue-600 focus:text-blue-600 active:text-blue-600" href="{{ route('threads.create') }}">
                                <span class="mr-1">&plus;</span>

                                <span>{{ __('New discussion') }}</span>
                            </a>
                        </li>

                        <li class="ml-6 dropdown">
                            <a class="bg-blue-200 shadow-none px-0 h-8 w-8 flex items-center justify-center rounded-full overflow-hidden dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="h-8 w-8" src="{{ asset('img/person.png') }}">
                            </a>

                            <div class="mt-3 dropdown-menu dropdown-menu-right rounded-lg shadow-lg" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item text-sm font-semibold text-gray-700 hover:text-gray-800 focus:text-white active:text-white py-2" href="#">{{ __('Profile') }}</a>
                                <a class="dropdown-item text-sm font-semibold text-gray-700 hover:text-gray-800 focus:text-white active:text-white py-2" href="#">{{ __('Settings') }}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-sm font-semibold text-gray-700 hover:text-gray-800 focus:text-white active:text-white py-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Sign out') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="ml-6">
                            <a class="text-sm font-semibold text-blue-500 hover:text-blue-600 focus:text-blue-600 active:text-blue-600" href="{{ route('login') }}">
                                <span>{{ __('Sign in') }}</span>

                                <span class="ml-1">&rarr;</span>
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

            <div class="dropdown block md:hidden">

            </div>
        </div>
    </div>
</nav>
