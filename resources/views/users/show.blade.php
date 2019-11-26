@extends('layouts.app')

@section('content')
    <section id="user-profile-section">
        @include('users.components.profile', ['user' => $user])

        @include('users.components.activity.feed', ['user' => $user, 'activities' => $activities])
    </section>
@endsection

@section('sidebar')
    @include('users.components.sidebar')
@endsection
