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
                            <a class="text-sm" href="/threads"><span class="mr-1">&larr;</span> Back to threads</a>

                            @auth
                                <a class="ml-6 text-sm" href="/">Subscribe</a>
                            @endauth

                            @can('update', $thread)
                                <a class="ml-6 text-sm" href="#" role="button" data-toggle="modal" data-target="#threadModal">Edit</a>

                                <a class="ml-6 text-sm" href="/">Delete</a>
                            @endcan
                        </div>

                        <div class="mt-10 flex items-start">
                            <div class="flex-no-shrink h-12 w-12">
                                <a class="bg-blue-200 shadow-none px-0 h-12 w-12 flex items-center justify-center rounded-full overflow-hidden dropdown-toggle" href="#">
                                    <img class="h-12 w-12" src="{{ $thread->user->image }}">
                                </a>
                            </div>

                            <div class="ml-6 text-lg text-gray-700">
                                <div>
                                    <h6 class="font-semibold text-gray-800 text-base">{{ $thread->user->name }}</h6>

                                    <span class="text-sm text-gray-500">{{ $thread->updated_at->diffForHumans() }}</span>
                                </div>

                                <div class="mt-2 prose">
                                    {{ $thread->body }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="threadModal" tabindex="-1" aria-labelledby="threadModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg rounded-lg overflow-hidden">
                            <form class="modal-content" action="{{ route('threads.update', $thread) }}" method="POST">
                                @csrf

                                @method('PUT')

                                <div class="modal-header pb-0">
                                    <div class="w-full">
                                        <label class="block">
                                            <input name="title" id="title" class="form-input mt-1 md:border-transparent md:bg-white text-gray-800 font-bold text-lg block w-full" value="{{ $thread->title }}" placeholder="Add a title">
                                        </label>
                                    </div>

                                    <button type="button" class="close font-normal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body pt-0">
                                    <hr class="my-6">

                                    <div>
                                        <textarea id="body" name="body" class="form-textarea md:border-transparent md:bg-white block w-full" rows="10" placeholder="What's on your mind?">{{ $thread->body }}</textarea>

                                        <div class="mt-2">
                                            <span class="text-sm text-gray-500">You may use Markdown with <a href="https://help.github.com/articles/creating-and-highlighting-code-blocks/">GitHub-flavored</a> code blocks. </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer justify-between">
                                    <div>
                                        <label class="block">
                                            <select name="channel_id" id="channel_id" class="form-select block w-full bg-white text-sm font-medium shadow">
                                                <option>Choose a channel</option>

                                                @foreach ($channels as $channel)
                                                    <option @if ($thread->channel->is($channel)) selected @endif value="{{ $channel->id }}">{{ $channel->name }}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                    </div>

                                    <div class="flex items-center justify-end">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                                        <button type="submit" class="ml-4 btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @auth
                        <div class="mt-10 flex items-start">
                            <div class="flex-no-shrink h-12 w-12">
                                <a class="bg-blue-200 shadow-none px-0 h-12 w-12 flex items-center justify-center rounded-full overflow-hidden dropdown-toggle" href="#">
                                    <img class="h-12 w-12" src="{{ user('image') }}">
                                </a>
                            </div>

                            <div class="flex-1 ml-6 text-lg text-gray-700">
                                <form class="w-full" action="{{ route('replies.store', ['thread' => $thread]) }}" method="POST">
                                    @csrf

                                    <div>
                                        <textarea id="body" name="body" class="form-textarea block w-full" rows="3" placeholder="Type here to reply to thread"></textarea>
                                    </div>

                                    <div class="mt-6">
                                        <button class="btn btn-primary leading-8">Post comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="mt-10">
                            <div class="rounded-lg px-4 py-5 sm:px-6 border-2 border-dotted border-gray-300 text-center text-sm">
                                <a href="{{ route('login') }}">Sign in</a> or <a href="{{ route('register') }}">create an account</a> to reply to this conversation.
                            </div>
                        </div>
                    @endauth

                    <div class="my-20">
                        <div>
                            <h5>{{ $thread->replies_count }} comments</h5>
                        </div>

                        <div class="mt-6">
                            @foreach ($thread->replies as $reply)
                                <div class="mb-6 flex items-start">
                                    <div class="flex-no-shrink h-8 w-8">
                                        <a class="bg-blue-200 shadow-none px-0 h-8 w-8 flex items-center justify-center rounded-full overflow-hidden dropdown-toggle" href="#">
                                            <img class="h-8 w-8" src="{{ $reply->user->image }}">
                                        </a>
                                    </div>

                                    <div class="ml-6 text-gray-700">
                                        <div class="mt-1 leading-none">
                                            <h6 class="font-semibold text-gray-800">{{ $reply->user->name }}</h6>
                                        </div>

                                        <div class="mt-4 text-sm leading-relaxed">
                                            {{ $reply->body }}
                                        </div>

                                        <div class="mt-4 flex items-center">
                                            <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>

                                            @can('update', $reply)
                                                <a class="ml-4 text-xs text-gray-500" href="#" role="button" data-toggle="modal" data-target="#replyModal">Edit</a>

                                                <a class="ml-4 text-xs text-gray-500" href="{{ route('replies.destroy', ['thread' => $thread, 'reply' => $reply]) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $reply->id }}').submit();">
                                                    Delete
                                                </a>

                                                <form id="delete-form-{{ $reply->id }}" action="{{ route('replies.destroy', ['thread' => $thread, 'reply' => $reply]) }}" method="POST" style="display: none;">
                                                    @csrf

                                                    @method('DELETE')
                                                </form>
                                            @endcan

                                            @auth
                                                <a class="ml-4 text-xs text-gray-500" href="/">3 Likes</a>

                                                <a class="ml-4 text-xs text-gray-500" href="/">Reply</a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog rounded-lg overflow-hidden">
                                        <form class="modal-content" action="{{ route('replies.update', ['thread' => $thread, 'reply' => $reply]) }}" method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="replyModalLabel">Reply to <span class="font-semibold text-blue-500">conversation</span></h5>

                                                <button type="button" class="close font-normal" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                @csrf

                                                @method('PUT')

                                                <textarea id="body" name="body" class="form-textarea block w-full" rows="10" placeholder="Type here to reply to thread">{{ $reply->body }}</textarea>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                                                <button type="submit" class="ml-4 btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
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
                                <a href="#" class="block font-semibold text-sm">Contact support</a>

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
