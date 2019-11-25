@extends('layouts.app')

@section('content')
    <section id="user-profile-section" class="py-12">
        @include('users.components.settings', ['user' => $user])
    </section>
@endsection

@section('sidebar')
    @include('users.components.sidebar')
@endsection
