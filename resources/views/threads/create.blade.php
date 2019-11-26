@extends('layouts.app')

@section('content')
    <section class="py-12" id="create-section">
        <div class="row mb-16">
            <div class="col flex items-center">
                <div>
                    <h2 class="text-2xl text-gray-800 font-bold m-0">Create New Thread</h2>

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

                    @include('threads.components.forms.fields.title')

                    @include('threads.components.forms.fields.body')

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
