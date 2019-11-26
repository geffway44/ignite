@component('users.components.activity.activity')
    @slot('heading')
        <a class="text-indigo-500 hover:text-indigo-400" href="{{ route('user.show', ['user' => $user->username]) }}">{{ $user->name }}</a> replied to
        <a class="font-bold text-gray-800" href="{{ $activity->subject->thread->path() }}">"{{ $activity->subject->thread->title }}"</a>
    @endslot

    @slot('body')
        {!! parse($activity->subject->body) !!}
    @endslot
@endcomponent
