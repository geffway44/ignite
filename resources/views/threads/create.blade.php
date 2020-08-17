@extends('layouts.web.base')

@section('content')
    <section class="py-8">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8">
                    <div>
                        <h4>
                            Create new discussion
                        </h4>

                        <h6 class="text-gray-600 max-w-sm">
                            If you want technical support, you can also send our support team a <a href="/">quick email</a>
                        </h6>
                    </div>

                    <form class="mt-10" action="{{ route('threads.store') }}" method="POST">
                        @csrf

                        <div class="flex items-center">
                            <div class="flex-1">
                                <label class="block">
                                    <input class="form-input mt-1 border-transparent bg-white text-gray-800 font-bold text-lg block w-full" placeholder="Add a title">
                                </label>
                            </div>

                            <div class="ml-4">
                                <label class="block">
                                    <select name="channel_id" id="channel_id" class="form-select mt-1 block w-full bg-white shadow">
                                        <option>Choose a channel</option>
                                        <option>Pharetra</option>
                                        <option>Venenatis</option>
                                        <option>Pharetra</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="mt-6">
                            <textarea id="body" name="body" class="form-textarea block w-full" rows="7" placeholder="What's on your mind?"></textarea>

                            <div class="mt-2">
                                <span class="text-sm text-gray-500">You may use Markdown with <a href="https://help.github.com/articles/creating-and-highlighting-code-blocks/">GitHub-flavored</a> code blocks. </span>
                            </div>
                        </div>

                        <div class="mt-10">
                            <button class="btn btn-primary">Create discussion</button>
                        </div>
                    </form>
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