@extends('layouts.app')

@section('content')
    <section id="user-profile-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    {{ $user->username }}
                </div>
            </div>
        </div>
    </section>
@endsection
