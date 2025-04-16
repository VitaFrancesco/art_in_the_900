<nav id="navbar" class="d-flex align-items-center justify-content-between py-3 px-5">
    <a class="logo" href="{{ route('home') }}">
        <div>
            <div class="log_div">L</div>
            <div class="log_div">O</div>
            <div class="log_div">G</div>
            <div class="log_div">O</div>
        </div>
    </a>
    <ul class="d-flex align-items-center gap-3 p-0 m-0">
        <li>
            <a @if (Route::currentRouteNamed('home')) class="active_custom" @endif href="{{ route('home') }}">Home</a>
        </li>
        <li>
            <a @if (Route::currentRouteNamed('works.*')) class="active_custom" @endif
                href="{{ route('works.index') }}">Opere</a>
        </li>
        <li>
            <a @if (Route::currentRouteNamed('artists.*')) class="active_custom" @endif
                href="{{ route('artists.index') }}">Artisti</a>
        </li>
        <li>
            <a @if (Route::currentRouteNamed('movements.*')) class="active_custom" @endif
                href="{{ route('movements.index') }}">Movimenti</a>
        </li>
    </ul>
    <div class="logout">
        <div class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    </a>
</nav>
