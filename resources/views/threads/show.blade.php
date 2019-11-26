@extends('layouts.app')

@section('content')
    <thread :thread="{{ $thread }}" inline-template>
        <section id="threads-section" class="py-12">
            <div class="row mb-12">
                <div class="col">
                    <div class="mb-12">
                        <h2 class="text-4xl text-gray-800 font-bold m-0 leading-tight">
                            {{ $thread->title }}
                        </h2>

                        <div class="mt-5 text-lg">
                            <a href="{{ url('/threads') }}" class="whitespace-no-wrap text-indigo-500 hover:text-indigo-400 mr-6">
                                <span class="mr-1">&larr;</span> Back to community
                            </a>

                            <subscribe subscribed="{{ $thread->isSubscribedTo }}"></subscribe>

                            <a href="#" class="whitespace-no-wrap text-gray-500 hover:text-gray-600 mr-6" data-toggle="modal" data-target="#editModal">Edit</a>

                            @can('delete', $thread)
                                <form class="inline" method="POST" action="{{ route('threads.destroy', ['channel' => $thread->channel->slug, 'thread' => $thread->slug]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="whitespace-no-wrap text-gray-500 hover:text-gray-600 mr-6">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>

                    <div class="flex">
                        <div>
                            <div class="w-16 h-16 mr-8 overflow-hidden">
                                <img class="h-full" src="{{ asset('img/avatars/default.svg') }}">
                            </div>
                        </div>

                        <div>
                            <div class="mb-4 flex items-center">
                                <span class="font-bold text-lg mr-3">{{ $thread->user->name }}</span> <span class="text-sm text-gray-500">{{ $thread->created_at->diffForHumans() }}</span>
                            </div>

                            <div class="markdown-container">
                                {!! parse($thread->body) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <replies :count="{{ $thread->replies_count }}"></replies>
        </section>
    </thread>
@endsection

@section('sidebar')
    @include('threads.components.sidebar')
@endsection

@section('modals')
    @include('threads.components.modals.update')
@endsection
