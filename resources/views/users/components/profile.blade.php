<div class="row mb-5">
    <div class="col">
        <div class="py-12 flex items-center">
            <a href="#" class="mr-8 inline-block">
                <div class="h-32 w-32 overflow-hidden">
                    <img class="w-full" src="{{ asset('img/avatars/default.svg') }}" alt="{{ $user->username }}">
                </div>
            </a>

            <div>
                <h3 class="text-2xl max-w-xs font-semibold">{{ $user->name }}</h3>

                <h6 class="text-gray-500 text-lg mb-3">{{ '@' . $user->username }}</h6>

                <div class="text-gray-600 text-sm">
                    Member since {{ $user->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    </div>
</div>
