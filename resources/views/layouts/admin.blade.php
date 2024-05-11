<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Video Streaming</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Scripts -->
    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @yield('scripts')
    <style>
        body,
        html {
            height: 100%;
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            padding-top: 4rem; /* Adjust based on the height of your navbar */
        }

        .footer {
            flex-shrink: 0;
        }

        .bg-dark-red {
            background-color: #450A0A;
            /* Dark red color */
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .py-6 {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        a.tmdb {
            /* Define your default styles for the anchor tag with class 'tmdb' */
            color: white;
            /* Set default text color */
            text-decoration: underline;
            /* Remove underline */
        }

        a.tmdb:hover {
            /* Define your hover styles for the anchor tag with class 'tmdb' */
            color: grey;
            /* Change text color to grey on hover */
            text-decoration: underline;
            /* Underline the text on hover */
        }
        .maincircle_long {
            text-transform: uppercase;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 50px;
            margin: 5px;
            display: inline-block;
            width: 120px;
            text-align: center;
            transition: 0.4s ease-in-out;
            font-size: 16px;
            color: white;

        }
        .maincircle_long:hover {
            text-transform: uppercase;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 50px;
            margin: 5px;
            display: inline-block;
            width: 120px;
            text-align: center;
            color: black;
            background-color: #fff;
            font-size: 16px;

        }
        .maincircle_nav {
            text-transform: uppercase;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 50px;
            margin: 5px;
            display: inline-block;
            width: 150px;
            text-align: center;
            transition: 0.4s ease-in-out;
            font-size: 16px;
            color: white;

        }
        .maincircle_nav:hover {
            text-transform: uppercase;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 50px;
            margin: 5px;
            display: inline-block;
            width: 150px;
            text-align: center;
            color: black;
            background-color: #fff;
            font-size: 16px;

        }

        footer {
            background-color: #450A0A;
            color: white;
            padding: 1rem;
            width: 100%;
        }
    </style> 
</head>

<body>
    <div id="app"
        style="background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,1) 70%), url('/Rectangle 22.png') repeat center top;">
        <nav class="navbar navbar-expand-md navbar-light bg-dark-red shadow-sm">
            <div class="container" style="width:1200px;">
                <a class="navbar-brand" href="{{ route('movies.index') }}">
                    <img style="width: 12rem;" viewBox="0 0 96 24" fill="none" src="{{ URL('/logo 1.png') }}"
                        alt="">
                </a>
                <ul class="navbar-nav flex-row ml-auto">
                    <li class="nav-item">
                        <a class="nav-link maincircle_long" href="{{ route('trend.index') }}">Movies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link maincircle_long" href="{{ route('tv.index') }}">TV Shows</a>
                    </li>
                </ul>
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle maincircle_nav" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                        {{ __('Admin Dashboard') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="content">
            @yield('content')
        </main>
        <footer>
            <div class="container mx-auto text-sm px-4 py-6">
                Powered by <a href="https://www.themoviedb.org/documentation/api" class="underline tmdb">TMDb
                    API</a>
            </div>
        </footer>
    </div>
</body>

</html>
