@extends('layouts.web.base')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div>
                        <h4 class="mt-6">
                            Discussions &amp; Articles
                        </h4>

                        <h6 class="text-gray-600">
                            View all 0 discussions
                        </h6>
                    </div>

                    <div class="mt-10">
                        @forelse ($threads as $thread)
                            <div class="mb-8 flex items-start">
                                <div class="">
                                    <a href="#" class="block h-12 w-12 rounded-full overflow-hidden">
                                        <img class="h-12 w-12" src="{{ asset('img/person.png') }}">
                                    </a>
                                </div>

                                <div class="ml-6 flex-1">
                                    <a href="{{ $thread->path() }}">
                                        <h5 class="leading-snug">
                                            {{ $thread->title }}
                                        </h5>
                                    </a>

                                    <p class="mt-2 text-sm">
                                        {{ App\Support\Formatter::excerpt($thread->body, 100) }}
                                    </p>

                                    <div class="mt-4 text-xs">
                                        <a href="#">{{ $thread->user->name }}</a>

                                        <span class="mx-2"></span>

                                        <a href="#" class="text-gray-700 hover:text-gray-800">{{ $thread->channel->name }}</a>

                                        <span class="mx-2"></span>

                                        <span class="text-gray-500">{{ $thread->created_at->diffForHumans() }}</span>

                                        <span class="mx-2"></span>

                                        <span class="text-gray-500">12 replies</span>

                                        <span class="mx-2"></span>

                                        <span class="text-gray-500">15 views</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div>
                                <p class="mt-2 text-sm">
                                    No threads found.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
