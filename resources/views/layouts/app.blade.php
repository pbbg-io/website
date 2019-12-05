<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ mix('css/titan.css') }}">

    <title>{{ config('app.name') }}</title>

</head>
<body>


<div class="d-md-none fixed-top" id="toggle-nav-parent">
    <a href="#" id="toggle-nav" style="padding: 50px;" class="d-block">
        <i class="fas fa-bars"></i>
    </a>
</div>

<nav class="text-center fixed-top d-none d-md-flex navbar p-0" id="main-nav">
    <ul class="list-unstyled mb-0">
        <li class="d-inline-block">
            <a href="/" onclick="hideMenu()"><i class="fas fa-home"></i> Home</a>
        </li>
        <li class="d-inline-block">
            <a href="{{ route('marketplace.search') }}" onclick="hideMenu()"><i class="fas fa-balance-scale-left"></i> Marketplace</a>
        </li>
        <li class="d-inline-block">
            <a href="https://pbbg-io.gitbook.io/titan"><i class="fas fa-books"></i> Documentation</a>
        </li>
        <li class="d-inline-block">
            <a href="https://github.com/pbbg-io/titan-demo"><i class="fab fa-github"></i> Github</a>
        </li>
    </ul>
    <ul class="list-unstyled mb-0">
        @guest
            <li class="d-inline-block">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="d-inline-block">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</nav>

<div id="nav-spacer"></div>
@yield('content')

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script type="text/javascript">

    (function () {
        document.getElementById('toggle-nav').addEventListener('click', function () {
            let nav = document.getElementById("main-nav");
            nav.classList.toggle('d-flex');
            nav.classList.toggle('open');
        });

    })();

    function hideMenu() {

        document.getElementById('toggle-nav').click();
    }
</script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/f15b7be07c.js" crossorigin="anonymous"></script>

@yield('scripts')
</body>
</html>
