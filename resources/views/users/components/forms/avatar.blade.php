<div class="mb-12 max-w-sm">
    <div class="flex items-center">
        <div>
            <div class="mr-8 block">
                <div class="h-32 w-32 overflow-hidden">
                    <img class="w-full" src="{{ asset('img/avatars/default.svg') }}" alt="{{ $user->username }}">
                </div>
            </div>
        </div>

        <div>
            <div class="mb-5">
                <span class="text-gray-500">
                    Update your avatar. Be sure to use an image less than 25MB.
                </span>
            </div>

            <avatar :user="{{ $user }}"></avatar>
        </div>
    </div>
</div>
