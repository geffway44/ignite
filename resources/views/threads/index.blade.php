@extends('layouts.app')

@section('content')
    <section id="threads-section" class="py-12">
        <div class="row mb-16">
            <div class="col flex items-center justify-between">
                <div>
                    <h2 class="text-2xl text-gray-800 font-bold m-0">Discussions &amp; Articles</h2>

                    <span class="text-gray-500">
                        View all {{ count($threads) }} discussion
                    </span>
                </div>

                <a href="{{ route('threads.create') }}" class="whitespace-no-wrap rounded-full bg-indigo-500 hover:bg-indigo-400 outline-none focus:outline-none px-8 py-4 leading-none text-white text-sm">Create New Post</a>
            </div>
        </div>

        @forelse ($threads as $thread)
            <div class="row mb-12">
                <div class="col flex items-center">
                    <div class="w-12 h-12 mr-10 overflow-hidden">
                        <img class="h-full" src="{{ asset('img/avatars/default.svg') }}">
                    </div>

                    <div>
                        <h3 class="text-gray-800 text-xl font-medium m-0 relative">
                            <a href="{{ $thread->path() }}">{{ $thread->title }}</a>

                            @if ($thread->hasUpdatesFor(auth()->user()))
                                <span class="rounded-full bg-indigo-500 h-2 w-2 inline-block">&nbsp;</span>
                            @endif
                        </h3>

                        <div class="flex items-center">
                            <a href="{{ route('user.show', ['user' => auth()->user()->username]) }}" class="text-indigo-500 hover:text-indigo-400 mr-4">
                                {{ $thread->user->name }}
                            </a>

                            <span class="text-gray-500 text-sm mr-4">
                                {{ $thread->created_at->diffForHumans() }}
                            </span>

                            <span class="text-gray-500 text-sm mr-4">
                                {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                            </span>

                            <span class="text-gray-500 text-sm mr-4">
                                {{ $thread->visits }} {{ str_plural('visit', $thread->visits) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="col">
                    <span class="text-sm text-gray-500">
                        No threads found.
                    </span>
                </div>
            </div>
        @endforelse
    </section>
@endsection

@section('sidebar')
    @include('threads.components.sidebar')
@endsection
