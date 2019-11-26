<div class="row">
    <div class="col">
        <h3 class="text-2xl text-gray-800 font-bold mb-5">Recent Activity</h3>

        @forelse ($activities as $date => $activity)

            <div class="rounded-lg py-4 px-10 bg-gray-100 my-4">
                From <span class="font-semibold">{{ $date }}</span>
            </div>

            <div class="mb-8">
                @foreach ($activity as $record)
                    @if (view()->exists("users.components.activity.{$record->type}"))
                        @include ("users.components.activity.{$record->type}", ['activity' => $record])
                    @endif
                @endforeach
            </div>
        @empty
            <p>There is no activity for this user yet.</p>
        @endforelse
    </div>
</div>
