<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="#">{{ $namePage }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
                <li class="nav-item @if ($activePage == 'login') active @endif ">
                    <a href="{{ route('login') }}" class="nav-link">
                        <i class="now-ui-icons users_circle-08"></i> {{ __("Login") }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
