@component('users.components.activity.activity')
    @slot('heading')
        <a class="text-indigo-500 hover:text-indigo-400" href="{{ route('user.show', ['user' => $user->username]) }}">{{ $user->name }}</a> published
        <a class="font-bold text-gray-800" href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a>
    @endslot

    @slot('body')
        {!! parse($activity->subject->body) !!}
    @endslot
@endcomponent
