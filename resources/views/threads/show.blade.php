@extends('layouts.app')

@section('content')
    <thread :thread="{{ $thread }}" inline-template>
        <section id="threads-section" class="py-12">
            <div class="row mb-16">
                <div class="col">
                    <div class="mb-12">
                        <h2 class="text-4xl text-gray-800 font-bold m-0 leading-tight">
                            {{ $thread->title }}
                        </h2>

                        <div class="mt-5 text-lg">
                            <a href="/threads" class="text-indigo-500 hover:text-indigo-400 mr-6">Back to community</a>

                            <a href="/threads" class="text-gray-500 hover:text-gray-600 mr-6">Edit</a>

                            <a href="/threads" class="text-gray-500 hover:text-gray-600 mr-6">Follow</a>

                            <a href="/threads" class="text-gray-500 hover:text-gray-600 mr-6">Report</a>
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

                            <p class="text-lg text-gray-600">
                                {{ $thread->body }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="font-semibold text-gray-800 text-xl mb-5">
                <span v-text="repliesCount"></span> comments
            </div>

            <replies @added="repliesCount++" @removed="repliesCount--"></replies>
        </section>
    </thread>
@endsection

@section('sidebar')
    <section class="py-12">
        <div class="mb-4">
            <h2 class="text-2xl text-gray-800 font-bold m-0">General Links</h2>

            <span class="text-gray-500">
                To make it easy for you to navigate around the site.
            </span>
        </div>

        <ul class="unstyled">
            <li class="block py-3">
                <a href="/" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium">
                    All threads
                </a>
            </li>

            <li class="block py-3">
                <a href="/" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium">
                    Popular threads
                </a>
            </li>

            <li class="block py-3">
                <a href="/" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium">
                    Unsolved threads
                </a>
            </li>

            <li class="block py-3">
                <a href="/" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium">
                    Solved threads
                </a>
            </li>

            <li class="block py-3">
                <a href="/" class="text-gray-700 hover:text-indigo-500 whitespace-no-wrap font-medium">
                    My threads
                </a>
            </li>
        </ul>
    </section>
@endsection
