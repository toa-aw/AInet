<nav>
    {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}

    <!-- Left Side Of Navbar -->

    <!-- Right Side Of Navbar -->
    <ul>
        <!-- Authentication Links -->
        @guest
        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
        <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
        @else
            {{-- <a class="btn btn-xs btn-primary" ">Edit</a> --}}

            <div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}
                <a class="pull-right" href="{{ route('password.edit', Auth::id()) }}"> {{ __('Change Password')  }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    <action="{{ route('logout') }}" method="POST">
                        @csrf
                </form>
            </div>
        </li>
        @endguest
    </ul>
</nav>