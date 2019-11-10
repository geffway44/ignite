@extends('layouts.app')

@section('content')
    <section id="user-profile-section" class="py-12">
        <div class="container">
            <div class="row mb-16">
                <div class="col flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl text-gray-800 font-bold m-0">Channels &amp; Discussions</h2>

                        <span class="text-gray-500">
                            View all {{ count($channels) }} channels
                        </span>
                    </div>
                </div>
            </div>

            <div class="row mb-12">
                @foreach ($channels as $channel)
                    <div class="col-md-4 items-center mb-8">
                        <div class="py-4 px-5 rounded-lg border border-gray-200 flex flex-col flex-1 justify-between hover:shadow-md cursor-pointer">
                            <div class="mb-16">
                                <h6 class="text-gray-800 text-lg font-bold">
                                    <a href="{{ route('threads.index', ['channel' => $channel->slug]) }}">{{ $channel->name }}</a>
                                </h6>

                                <div class="text-sm text-gray-500 mb-3">
                                    {{ count($channel->threads) }} active discussion.
                                </div>
                            </div>

                            <div class="text-xs text-gray-500">
                                Last updated {{ $channel->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('sidebar')
    @include('threads.partials.sidebar')
@endsection
