@extends('layouts.main')

@section('content')
    <style>
        .zoom_prod {
            height: auto;
            overflow: hidden;
            border-radius: 5%;
            border-color: transparent;
        }

        .zoom_prod:hover img {
            transform: scale(1.15);
        }

        .zoom_prod img {
            transition: transform .5s ease;
            height: 345px;
            object-fit: cover;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
        }

        .swiper {
            width: 100%;
            height: 620px;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .swiper-pagination-bullet {
            background: white;
        }

        .swiper-button-next {
            font-weight: 900;
            color: #ff0000;
        }

        .swiper-button-next:hover {
            font-weight: 900;
            color: #990000;
        }

        .swiper-button-prev {
            font-weight: 900;
            color: #ff0000;
        }

        .swiper-button-prev:hover {
            font-weight: 900;
            color: #990000;
        }

        .swiper-button-next1 {
            font-weight: 900;
            color: #ff0000;
        }

        .swiper-button-next1:hover {
            font-weight: 900;
            color: #990000;
        }

        .swiper-button-prev1 {
            font-weight: 900;
            color: #ff0000;
        }

        .swiper-button-prev1:hover {
            font-weight: 900;
            color: #990000;
        }

        .swiper-button-next2 {
            font-weight: 900;
            color: ##ff0000;
        }

        .swiper-button-next2:hover {
            font-weight: 900;
            color: #990000;
        }

        .swiper-button-prev2 {
            font-weight: 900;
            color: #ff0000;
        }

        .swiper-button-prev2:hover {
            font-weight: 900;
            color: #990000;
        }

        .overview-text {
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 10.5em;
            /* Adjust as needed */
            transition: max-height 0.3s ease;
            /* Add smooth transition */
        }

        /* Show full text when expanded */
        .overview-text.show-full {
            max-height: auto;
        }

        .circle {
            text-transform: uppercase;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 50px;
            margin: 5px;
            display: inline-block;
            width: 100px;
            text-align: center;

        }

        .circle_long {
            text-transform: uppercase;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 50px;
            margin: 5px;
            display: inline-block;
            width: 150px;
            text-align: center;

        }
    </style>
    <div
        style="background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 90%), url('/Rectangle 22.png') repeat center top;">
        <div style="padding-bottom:4rem;">
            <div class="swiper mySwiper" style="position: relative;">
                <div class="swiper-wrapper">
                    @foreach ($popularMovies as $movie)
                        @if ($loop->index < 5)
                            @if (strlen($movie['media_type']) == 5)
                                <div class="swiper-slide">
                                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                        <tbody>
                                            <tr>
                                                <td style="position:relative;top:100px;"><img
                                                        src="{{ 'https://image.tmdb.org/t/p/original/' . $movie['backdrop_path'] }}"
                                                        alt="movie poster" class="w-full h-full overflow-hidden">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        style="width:100%;position:absolute;top:20%;transform:translateY(-50%);margin: 0;
                                        background: linear-gradient(to left, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 100%);height:1000px;">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="movie-info">
                                                                        <div class="container mx-auto px-10 py-16 flex flex-col md:flex-row"
                                                                            style="display: flex;flex-direction: column;position:absolute;bottom:5%;">
                                                                            <div class="md:ml-24"
                                                                                style="width:30%;text-align:justify;font-weight:bold;">
                                                                                <h2 class="text-5xl mt-4 md:mt-0 mb-4 font-semibold"
                                                                                    style="color:white;text-align:left;">
                                                                                    {{ $movie['title'] }}</h2>
                                                                                <p class="overview-text"
                                                                                    style="font-family: 'Roboto', sans-serif;color:white;">
                                                                                    {{ $movie['overview'] }}</p>
                                                                                <div style="height:20px;"></div>
                                                                                <div class="text-sm" style="color:white;">
                                                                                    <span>{{ $movie['genre'] }}</span>
                                                                                </div>
                                                                                <div style="height:20px;"></div>
                                                                                <div
                                                                                    class="flex flex-wrap items-center text-gray-400 text-sm">
                                                                                    <svg class="fill-current text-orange-500 w-8"
                                                                                        viewBox="0 0 24 24">
                                                                                        <g data-name="Layer 2">
                                                                                            <path
                                                                                                d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                                                                                                data-name="star" />
                                                                                        </g>
                                                                                    </svg>
                                                                                    <span class="ml-1"
                                                                                        style="font-family: 'Roboto', sans-serif;font-weight:bold;font-size:18px;color:white;">{{ $movie['vote_average'] }}</span>
                                                                                    <span class="mx-2">|</span>
                                                                                    <span
                                                                                        class="bg-orange-500 text-gray-900 circle_long">{{ $movie['release_date'] }}</span>
                                                                                    <span class="mx-2">|</span>
                                                                                    <span
                                                                                        class="bg-orange-500 text-gray-900 circle">
                                                                                        {{ $movie['media_type'] }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <div>
                                                                                <div class="mt-12 md:ml-24"
                                                                                    style="text-align:left;">
                                                                                    <a
                                                                                        href="{{ route('movies.show', $movie['tmdb_id']) }}">
                                                                                        <button @click="isOpen = true"
                                                                                            class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">

                                                                                            <svg class="w-6 fill-current"
                                                                                                viewBox="0 0 24 24">
                                                                                                <path d="M0 0h24v24H0z"
                                                                                                    fill="none" />
                                                                                                <path
                                                                                                    d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                                                                            </svg>
                                                                                            <span
                                                                                                class="ml-2">Details</span>
                                                                                        </button>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> <!-- end movie-info -->
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:30px;">&nbsp;
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @elseif(strlen($movie['media_type']) <= 2)
                                <div class="swiper-slide">
                                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                        <tbody>
                                            <tr>
                                                <td style="position:relative;top:100px;"><img
                                                        src="{{ 'https://image.tmdb.org/t/p/original/' . $movie['backdrop_path'] }}"
                                                        alt="movie poster" class="w-full h-full overflow-hidden">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        style="width:100%;position:absolute;top:20%;transform:translateY(-50%);margin: 0;
                                        background: linear-gradient(to left, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 100%);height:1000px;">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="movie-info">
                                                                        <div class="container mx-auto px-10 py-16 flex flex-col md:flex-row"
                                                                            style="display: flex;flex-direction: column;position:absolute;bottom:5%;">
                                                                            <div class="md:ml-24"
                                                                                style="width:30%;font-weight:bold;text-align:justify;">
                                                                                <h2 class="text-5xl mt-4 md:mt-0 mb-4 font-semibold"
                                                                                    style="color:white;text-align:left;">
                                                                                    {{ $movie['title'] }}</h2>
                                                                                <p class="overview-text"
                                                                                    style="font-family: 'Roboto', sans-serif;color:white;">
                                                                                    {{ $movie['overview'] }}</p>
                                                                                <div style="height:20px;"></div>
                                                                                <div class="text-sm" style="color:white;">
                                                                                    <span>{{ $movie['genre'] }}</span>
                                                                                </div>
                                                                                <div style="height:20px;"></div>
                                                                                <div
                                                                                    class="flex flex-wrap items-center text-gray-400 text-sm">
                                                                                    <svg class="fill-current text-orange-500 w-8"
                                                                                        viewBox="0 0 24 24">
                                                                                        <g data-name="Layer 2">
                                                                                            <path
                                                                                                d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                                                                                                data-name="star" />
                                                                                        </g>
                                                                                    </svg>
                                                                                    <span class="ml-1"
                                                                                        style="font-family: 'Roboto', sans-serif;font-weight:bold;font-size:18px;color:white;">{{ $movie['vote_average'] }}</span>
                                                                                    <span class="mx-2">|</span>
                                                                                    <span
                                                                                        class="bg-orange-500 text-gray-900 circle_long">{{ $movie['release_date'] }}</span>
                                                                                    <span class="mx-2">|</span>
                                                                                    <span
                                                                                        class="bg-orange-500 text-gray-900 circle">
                                                                                        {{ $movie['media_type'] }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <div>
                                                                                <div class="mt-12 md:ml-24"
                                                                                    style="text-align:left;">
                                                                                    <a
                                                                                        href="{{ route('tv.show', $movie['tmdb_id']) }}">
                                                                                        <button @click="isOpen = true"
                                                                                            class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">

                                                                                            <svg class="w-6 fill-current"
                                                                                                viewBox="0 0 24 24">
                                                                                                <path d="M0 0h24v24H0z"
                                                                                                    fill="none" />
                                                                                                <path
                                                                                                    d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                                                                            </svg>
                                                                                            <span
                                                                                                class="ml-2">Details</span>
                                                                                        </button>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> <!-- end movie-info -->
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:30px;">&nbsp;
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                            @endif
                        @endif
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>


            <!-- Swiper JS -->
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

            <!-- Initialize Swiper -->
            <script>
                var swiper = new Swiper(".mySwiper", {
                    spaceBetween: 30,
                    centeredSlides: true,
                    autoplay: {
                        delay: 3500,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    loop: true, // Enable looping
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });
            </script>
            <div style="background-color: rgba(0, 0, 0, .7);padding-bottom:4rem;">
                <div class="container mx-auto"
                    style="display: flex;flex-wrap: wrap;justify-content: center;max-width:1366px;">
                    <div class="popular-movies px-10 pt-16">
                        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Movies</h2>
                        <div style="padding-top:10px;border-bottom: 6px solid orange;width:180px;"></div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                            @foreach ($Movies as $movie)
                                @if ($loop->index < 5)
                                    <x-movie-card :movie="$movie" />
                                @endif
                            @endforeach
                        </div>
                    </div> <!-- end pouplar-movies -->
                    <div class="top-rated-movies py-10">
                        <div class="px-10 pt-16">
                            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Rated Movies
                            </h2>
                            <div style="padding-top:10px;border-bottom: 6px solid orange;width:200px;"></div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                                @foreach ($topmovies as $movie)
                                    @if ($loop->index < 5)
                                        <x-movie-card :movie="$movie" />
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div> <!-- end top-rated-movies -->
                    <div class="popular-tv py-10">
                        <div class="px-10 pt-16">
                            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular TV Shows
                            </h2>
                            <div style="padding-top:10px;border-bottom: 6px solid orange;width:200px;"></div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                                @foreach ($poptv as $tvshow)
                                    @if ($loop->index < 5)
                                        <x-tv-card :tvshow="$tvshow" />
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div> <!-- end popular-tv -->
                    <div class="top-rated-tv py-10">
                        <div class="px-10 pt-16">
                            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Rated TV Show
                            </h2>
                            <div style="padding-top:10px;border-bottom: 6px solid orange;width:200px;"></div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                                @foreach ($toptv as $tvshow)
                                    @if ($loop->index < 5)
                                        <x-tv-card :tvshow="$tvshow" />
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div> <!-- end top-rated-tv -->
                </div>
            </div>
        </div>
    </div>
@endsection
