<div class="row">
    <div class="col-lg-8">
        @include('users.components.forms.account', ['user' => $user])

        @include('users.components.forms.security', ['user' => $user])
    </div>
</div>
