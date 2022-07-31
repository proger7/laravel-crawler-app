<nav class="navbar fixed-top navbar-expand-lg navbar-dark secondary-color-dark scrolling-navbar">
    <a class="navbar-brand" href="/">{{ __('account.logo') }}</a>
    
    @if (Route::has('login'))
        <div class="top-right links d-none d-sm-block">
            @auth
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                @if(Auth::user() &&  Auth::user()->admin == 1)
                    <a href="{{ url('/settings') }}">{{ __('account.settings_btn') }}</a>
                @endif
                <a href="{{ route('login') }}">{{ __('account.login_btn') }}</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">{{ __('account.register_btn') }}</a>
                @endif
            @endauth
        </div>
    @endif
</nav>