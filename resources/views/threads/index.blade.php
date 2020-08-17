@extends('layouts.web.base')

@section('content')
    <section class="py-8">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8">
                    <div>
                        <h4>
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

                <div class="col-lg-3 offset-xl-2 offset-lg-1">
                    <div class="rounded-lg overflow-hidden">
                        <div class="px-4 py-5 sm:px-6 bg-gray-100">
                            <div>
                                <a href="#">Contact support</a>

                                <div>
                                    <span class="text-gray-500 text-sm">24×7 help from our support staff</span>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div>
                                <h6 class="font-bold text-gray-800">Popular Topics</h6>

                                <div class="mt-4">
                                    <a class="inline-block text-sm" href="#">Sed posuere consectetur est at lobortis.</a>
                                    <a class="mt-2 inline-block text-sm" href="#">Etiam porta sem malesuada magna mollis euismod.</a>
                                    <a class="mt-2 inline-block text-sm" href="#">Nullam id dolor id nibh ultricies vehicula ut id elit.</a>
                                    <a class="mt-2 inline-block text-sm" href="#">Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
