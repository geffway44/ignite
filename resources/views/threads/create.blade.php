@extends('layouts.app')

@section('content')
    <section class="py-12" id="create-section">
        <div class="row mb-16">
            <div class="col flex items-center">
                <div>
                    <h2 class="text-2xl text-gray-800 font-bold m-0">Create new thread</h2>

                    <span class="text-gray-500">
                        Start a coversation by sharing your thoughts or asking a question.
                    </span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <form action="{{ route('threads.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-5">
                        <div class="col-md-8 mb-4">
                            <input type="text" class="bg-white text-lg font-bold text-gray-900 py-2 px-4 outline-none focus:outline-none w-full" id="title" name="title" placeholder="Give your thread a title" required>
                        </div>

                        <div class="col-md-4 mb-4">
                            <select class="block appearance-none bg-white py-2 px-4 outline-none focus:outline-none border border-gray-400 rounded-lg w-full pr-8 leading-tight" id="channel_id" name="channel_id" placeholder="Choose a channel..." required>
                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
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
                            <textarea class="bg-white py-2 px-4 border-none outline-none focus:outline-none w-full mb-4 " name="body" id="body" placeholder="What is on your mind?" rows="7" required></textarea>

                            <span class="text-xs text-gray-500">
                                * You may use Markdown with <a class="text-indigo-500 hover:text-indigo-400" target="_blank" href="https://help.github.com/articles/creating-and-highlighting-code-blocks/">GitHub flavored</a> code blocks.
                            </span>
                        </div>
                    </div>

                    <div class="row items-center justify-between">
                        <div class="col flex items-center justify-between">
                            <button type="submit" class="whitespace-no-wrap rounded-full bg-indigo-500 hover:bg-indigo-400 outline-none focus:outline-none px-8 py-4 leading-none text-white text-sm">Create Thread</button>

                            <a href="{{ url('/threads') }}" class="text-red-500 hover:text-red-400">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('sidebar')
    <section id="guide-section" class="py-12">
        <div class="border border-gray-200 rounded-lg py-4 px-5 bg-gray-100">
            <h6 class="font-bold text-xs uppercase tracking-widest text-gray-600 mb-5">Helpful Tips</h6>

            <p class="text-gray-500 text-sm mb-4">
                Your title helps people quickly understand what your question is about so they can answer it.
            </p>

            <p class="text-gray-500 text-sm mb-4">
                Your description gives people the information they need to help you answer your question.
            </p>

            <p class="text-gray-500 text-sm">
                If you have a question, don't hesitate to ask because we’ll help you find the best way to get your answer.
            </p>
        </div>
    </section>
@endsection
