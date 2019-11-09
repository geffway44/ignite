<script src="https://kit.fontawesome.com/2bfa06249e.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    window.App = {!! json_encode([
        'csrfToken' => csrf_token(),
        'user' => Auth::user(),
        'signedIn' => Auth::check()
    ]) !!};
</script>

<script src="{{ asset('js/app.js') }}"></script>


@stack('scripts')
