@extends('layouts.web.base')

@section('content')
    <section class="py-8">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8">
                    <div>
                        <h2 class="leading-tight text-gray-800">
                            {{ $thread->title }}
                        </h2>

                        <div class="mt-4 flex items-center">
                            <a class="text-sm" href="/"><span class="mr-1">&larr;</span> Back to threads</a>
                            <a class="ml-6 text-sm" href="/">Subscribe</a>
                            <a class="ml-6 text-sm" href="/">Edit</a>
                            <a class="ml-6 text-sm" href="/">Delete</a>
                        </div>

                        <div class="mt-10 flex items-start">
                            <div class="flex-no-shrink h-12 w-12">
                                <a class="bg-blue-200 shadow-none px-0 h-12 w-12 flex items-center justify-center rounded-full overflow-hidden dropdown-toggle" href="#">
                                    <img class="h-12 w-12" src="{{ asset('img/person.png') }}">
                                </a>
                            </div>

                            <div class="ml-6 text-lg text-gray-700">
                                <div class="mt-1 leading-none">
                                    <h6 class="font-semibold text-gray-800 text-lg">Matt Powells</h6>

                                    <span class="text-sm text-gray-500">{{ $thread->updated_at->diffForHumans() }}</span>
                                </div>

                                <div class="prose">
                                    {{ $thread->body }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 flex items-start">
                        <div class="flex-no-shrink h-12 w-12">
                            <a class="bg-blue-200 shadow-none px-0 h-12 w-12 flex items-center justify-center rounded-full overflow-hidden dropdown-toggle" href="#">
                                <img class="h-12 w-12" src="{{ asset('img/person.png') }}">
                            </a>
                        </div>

                        <div class="flex-1 ml-6 text-lg text-gray-700">
                            <form class="w-full">
                                <div>
                                    <textarea id="body" name="body" class="form-textarea block w-full" rows="3" placeholder="Type here to reply to thread"></textarea>
                                </div>

                                <div class="mt-6">
                                    <button class="btn btn-primary leading-8">Post comment</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="my-20">
                        <div>
                            <h5>{{ $thread->replies->count() }} comments</h5>
                        </div>

                        <div class="mt-6">
                            @foreach ($thread->replies as $reply)
                                <div class="flex items-start">
                                    <div class="flex-no-shrink h-8 w-8">
                                        <a class="bg-blue-200 shadow-none px-0 h-8 w-8 flex items-center justify-center rounded-full overflow-hidden dropdown-toggle" href="#">
                                            <img class="h-8 w-8" src="{{ asset('img/person.png') }}">
                                        </a>
                                    </div>

                                    <div class="ml-6 text-gray-700">
                                        <div class="mt-1 leading-none">
                                            <h6 class="font-semibold text-gray-800">{{ $reply->user }}</h6>
                                        </div>

                                        <div class="mt-4">
                                            {{ $reply->body }}
                                        </div>

                                        <div class="mt-4 flex items-center">
                                            <a class="text-xs text-gray-500" href="/">Edit</a>
                                            <a class="ml-4 text-xs text-gray-500" href="/">Delete</a>
                                            <a class="ml-4 text-xs text-gray-500" href="/">3 Likes</a>
                                            <a class="ml-4 text-xs text-gray-500" href="/">Reply</a>
                                            <span class="ml-4 text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
