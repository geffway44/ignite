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
                            <a href="{{ url('/threads') }}" class="text-indigo-500 hover:text-indigo-400 mr-6">
                                <span class="mr-1">&larr;</span> Back to community
                            </a>

                            <a href="#" class="text-gray-500 hover:text-gray-600 mr-6" data-toggle="modal" data-target="#editModal">Edit</a>

                            <subscribe subscribed="{{ $thread->isSubscribedTo }}"></subscribe>

                            <a href="#" class="text-gray-500 hover:text-gray-600 mr-6">Report</a>
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
    @include('threads.partials.sidebar')
@endsection

@section('modals')
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('threads.update', ['channel' => $thread->channel->slug, 'thread' => $thread->slug]) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row mb-5">
                            <div class="col-md-8 mb-4">
                                <input type="text" class="bg-white text-lg font-bold text-gray-900 py-2 px-4 outline-none focus:outline-none w-full" id="title" name="title" placeholder="Give your thread a title" value="{{ $thread->title }}" required>
                            </div>

                            <div class="col-md-4 mb-4">
                                <select class="block appearance-none bg-white py-2 px-4 outline-none focus:outline-none border border-gray-400 rounded-lg w-full pr-8 leading-tight" id="channel_id" name="channel_id" placeholder="Choose a channel..." required>
                                    @foreach ($channels as $channel)
                                        <option value="{{ $channel->id }}" @if ($thread->channel->id == $channel->id) selected @endif>{{ $channel->name }}</option>
                                    @endforeach
                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-0 mr-4 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>

                            <div class="col">
                                <div class="border-b border-gray-400 h-2 bg-transparent"></div>
                            </div>
                        </div>

                        <div class="row mb-10">
                            <div class="col">
                                <textarea class="bg-white py-2 px-4 border-none outline-none focus:outline-none w-full mb-4 " name="body" id="body" placeholder="What is on your mind?" rows="7" required>{{ $thread->body }}</textarea>

                                <span class="text-xs text-gray-500">
                                    * You may use Markdown with <a class="text-indigo-500 hover:text-indigo-400" target="_blank" href="https://help.github.com/articles/creating-and-highlighting-code-blocks/">GitHub flavored</a> code blocks.
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col flex items-center justify-between">
                                <button type="submit" class="whitespace-no-wrap rounded-full bg-indigo-500 hover:bg-indigo-400 outline-none focus:outline-none px-8 py-4 leading-none text-white text-sm">Update Thread</button>

                                <button type="button" class="text-red-500 hover:text-red-400" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
