<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('main.index') }}">{{ __('Main') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('main.about') }}">{{ __('About') }}</a>
                            </li>

                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @can('view', auth()->user())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home.admin.index') }}">{{ __('Admin') }}</a>
                                </li>
                            @endcan
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home.index') }}">{{ __('Manage') }}</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @guest()
                @yield('content')
            @else
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            @include('inc.home.sidebar')
                        </div>
                        <div class="col-md-8">
                            @yield('content')
                        </div>
                    </div>
                </div>
            @endguest
        </main>


        <footer class="pt-4 border-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h5>Features</h5>
                        <ul class="list-unstyled text-small">
                            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Cool
                                    stuff</a></li>
                            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Random
                                    feature</a></li>
                            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Team
                                    feature</a></li>
                            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Stuff for
                                    developers</a></li>
                            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Another
                                    one</a></li>
                            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Last
                                    time</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Resources</h5>
                        <ul class="list-unstyled text-small">
                            <li class="mb-1"><a class="link-secondary text-decoration-none"
                                    href="#">Resource</a>
                            </li>
                            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Resource
                                    name</a></li>
                            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Another
                                    resource</a></li>
                            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Final
                                    resource</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>About</h5>
                        <ul class="list-unstyled text-small">
                            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Team</a>
                            </li>
                            <li class="mb-1"><a class="link-secondary text-decoration-none"
                                    href="#">Locations</a>
                            </li>
                            <li class="mb-1"><a class="link-secondary text-decoration-none"
                                    href="#">Privacy</a>
                            </li>
                            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Terms</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
