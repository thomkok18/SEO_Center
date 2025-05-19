<x-guest-layout
    :name-page="'Verify Email'"
    :active-page="''"
    :css="asset('css/auth/verify-email.min.css')"
    :font-awesome="false"
    :class="'login-page sidebar-mini '"
    :background-image="asset('assets/img/bg14.webp')"
>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</div>

                    <div class="card-body">
                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success" role="alert">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <div class="mt-4 d-flex align-items-center justify-content-between">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div>
                                    <button type="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3">{{ __('Resend Verification Email') }}</button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3">{{ __('Log out') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
