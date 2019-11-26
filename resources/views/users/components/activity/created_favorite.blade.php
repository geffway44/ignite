@component('users.components.activity.activity')
    @slot('heading')
        <a class="text-indigo-500 hover:text-indigo-400" href="{{ route('user.show', ['user' => $user->username]) }}">{{ $user->name }}</a> favorited a reply.
    @endslot

    @slot('body')
        {!! $activity->subject->favorited->body !!}
    @endslot
@endcomponent
