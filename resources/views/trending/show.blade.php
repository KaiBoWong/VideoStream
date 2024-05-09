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
        }

        html {
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }

        .preview {
            width: 100%;
        }


        img.preview,
        img.modal-preview {
            opacity: 0.6;
        }

        img.active,
        .preview:hover,
        .modal-preview:hover {
            opacity: 1;
        }

        img.hover-shadow {
            transition: 0.3s;
        }

        .hover-shadow:hover {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .close {
            color: white;
            position: absolute;
            top: 10px;
            right: 25px;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #999;
            text-decoration: none;
            cursor: pointer;
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

        .btn_video {
            background-color: #333;
            color: #fff;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            margin: 0 4px;
            margin: 4px;
            /* Add margin to create space between buttons */
            border-radius: 4px;
            width: 70px;
        }

        .btn_video.active {
            background-color: #f7941d;
        }

        a.btn_video:hover {
            background-color: #450A0A;
            border-color: #450A0A;
            color: white;
        }

        .btn_video:hover {
            background-color: #f7941d;
            /* Darker blue color on hover */
        }
    </style>
    <div class="movie-info"
        style="background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 40%), url('https://image.tmdb.org/t/p/original/{{ $Trendmovie['backdrop_path'] }}') no-repeat center top;">
        <div style="background-color: rgba(0, 0, 0, 0.80);">
            <div class="container mx-auto px-10 py-16 rounded-lg" style="max-width:1366px;">
                @if (count($Trendmovie['videos']['results']) > 0)
                    <div class="responsive-container overflow-hidden relative">
                        <iframe id="videoIframe" style="width:100%;height:600px;" class="responsive-iframe"
                            src="https://www.youtube.com/embed/{{ $Trendmovie['videos']['results'][0]['key'] }}"
                            style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                    <div style="background-color:#ff00004d;" class="py-4 px-4">
                        <div class="flex flex-wrap left">
                            @for ($i = 0; $i < count($Trendmovie['videos']['results']); $i++)
                                <button class="btn_video {{ $i === 0 ? 'active' : '' }}"
                                    onclick="changeVideo('{{ $Trendmovie['videos']['results'][$i]['key'] }}', this)">
                                    PV{{ $i + 1 }}
                                </button>
                                @if (($i + 1) % 16 === 0)
                                    <div class="w-full"></div> <!-- Add a line break after every 15 buttons -->
                                @endif
                            @endfor
                        </div>
                    </div>
                @else
                    <p>No video available for this movie.</p>
                @endif

            </div>
            <script>
                document.querySelector('.btn_video').classList.add('active');

                function changeVideo(videoKey, button) {
                    var iframe = document.getElementById('videoIframe');
                    iframe.src = "https://www.youtube.com/embed/" + videoKey;

                    // Remove 'active' class from all buttons
                    document.querySelectorAll('.btn_video').forEach(btn => {
                        btn.classList.remove('active');
                    });

                    // Add 'active' class to the clicked button
                    button.classList.add('active');
                }
            </script>
            <div class="container mx-auto px-10 py-16 flex flex-col md:flex-row" style="max-width:1366px;">
                <div class="flex-none">
                    <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $Trendmovie['poster_path'] }}" alt="poster"
                        class="w-64 lg:w-96 shadow-lg shadow-orange-500">
                </div>
                <div class="md:ml-24">
                    <h2 class="text-5xl mt-4 md:mt-0 mb-4 font-semibold">{{ $Trendmovie['title'] }}</h2>
                    <div class="flex flex-wrap items-center text-gray-400 text-sm">
                        <span class="ml-1 circle_long bg-orange-500 text-gray-900">MOVIE</span>
                        <span class="mx-2">|</span>
                        <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                            <g data-name="Layer 2">
                                <path
                                    d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                                    data-name="star" />
                            </g>
                        </svg>
                        <span class="ml-1">{{ number_format($Trendmovie['vote_average'], 2) }}</span>
                        <span class="mx-2">|</span>
                        <span>{{ $Trendmovie['release_date'] }}</span>
                        <span class="mx-2">|</span>
                        <span>
                            @foreach ($Trendmovie['genres'] as $genre)
                                {{ $genre['name'] }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </span>
                    </div>

                    <p class="text-gray-300 mt-8 text-justify" style="font-size:18px;">
                        {{ $Trendmovie['overview'] }}
                    </p>

                    <div class="mt-12">
                        <h4 class="text-white font-semibold">Featured Crew</h4>
                        <div class="flex mt-4">
                            @foreach ($Trendmovie['credits']['crew'] as $crew)
                                @if ($loop->index < 3)
                                    <div class="mr-10">
                                        <div>{{ $crew['name'] }}</div>
                                        <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                                    </div>
                                @else
                                @break
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div> <!-- end movie-info -->

        <div class="movie-cast">
            <div class="container mx-auto px-10 py-16" style="max-width:1366px;">
                <h2 class="text-4xl font-semibold">Cast</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($Trendmovie['credits']['cast'] as $cast)
                        @if ($loop->index < 5)
                            <div class="mt-8">
                                <table class="shadow-lg shadow-orange-500" style="border-radius: 5%;">
                                    <tbody>
                                        <tr>
                                            <td class="products-container">
                                                <table border="0" cellpadding="0" cellspacing="0"
                                                    style="width: 100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="photo_hoverpointProd" style="position: relative">
                                                                <table border="0" cellpadding="0" cellspacing="0"
                                                                    style="width: 100%;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="zoom_prod">
                                                                                @if ($cast['profile_path'])
                                                                                    <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $cast['profile_path'] }}"
                                                                                        alt="actor1"
                                                                                        class="hover:scale-125 transition ease-in-out duration-50 hover-shadow preview">
                                                                                @else
                                                                                    <img src="/img/notfound.jpg"
                                                                                        alt="movie poster"
                                                                                        class="hover:scale-125 transition ease-in-out duration-50 hover-shadow preview"
                                                                                        style="width: 230px;height:345px;">
                                                                                @endif
                                                                                <table border="0" cellpadding="0"
                                                                                    cellspacing="0" class="photo_prod"
                                                                                    style="width: 100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <img src="/data/cms/images/trans.gif"
                                                                                                    style="width: 10px; height: 1px;" />
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <td>
                                        <img src="/data/cms/images/trans.gif" style="width: 10px; height: 10px;" />
                                    </td>
                                </div>
                                <div class="mt-2  py-2">
                                    <a href="#" class="text-lg mt-2 hover:text-gray:300">{{ $cast['name'] }}</a>
                                    <div class="text-sm text-gray-400">
                                        {{ $cast['character'] }}
                                    </div>
                                </div>
                            </div>
                        @else
                        @break
                    @endif
                @endforeach
            </div>
        </div> <!-- end movie-cast -->

        <div class="movie-images" x-data="{ isOpen: false, image: '' }">
            <div class="container mx-auto px-10 py-16" style="max-width:1366px;">
                <h2 class="text-4xl font-semibold">Images</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach ($Trendmovie['images']['backdrops'] as $image)
                        @if ($loop->index < 9)
                            <div class="mt-8">
                                <a @click.prevent="
                                        isOpen = true
                                        image='{{ 'https://image.tmdb.org/t/p/original/' . $image['file_path'] }}'
                                    "
                                    href="#">
                                    <table class="shadow-lg shadow-orange-500" style="border-radius: 5%;">
                                        <tbody>
                                            <tr>
                                                <td class="products-container">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        style="width: 100%;">
                                                        <tbody>
                                                            <tr>
                                                                <td class="photo_hoverpointProd"
                                                                    style="position: relative">
                                                                    <table border="0" cellpadding="0"
                                                                        cellspacing="0" style="width: 100%;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="zoom_prod">
                                                                                    @if ($image['file_path'])
                                                                                        <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $image['file_path'] }}"
                                                                                            alt="image1"
                                                                                            class=" hover:scale-125 transition ease-in-out duration-150 hover-shadow preview">
                                                                                    @else
                                                                                        <img src="/img/notfound.jpg"
                                                                                            alt="movie poster"
                                                                                            class=" hover:scale-125 transition ease-in-out duration-150 hover-shadow preview"
                                                                                            style="width: 196px;height:294.6px;">
                                                                                    @endif
                                                                                    <table border="0"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0"
                                                                                        class="photo_prod"
                                                                                        style="width: 100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img src="/data/cms/images/trans.gif"
                                                                                                        style="width: 10px; height: 1px;" />
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </a>
                            </div>
                        @else
                        @break
                    @endif
                @endforeach
            </div>

            <div style="background-color: rgba(0, 0, 0, .5);position:absolute !important;z-index:999999 !important;"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                x-show="isOpen">
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto"
                    style="display:flex;justify-content:center;align-items:center;">
                    <div class="rounded fixed top-0" style="background-color: rgba(0, 0, 0, .5);">
                        <div class="flex justify-end pr-4 pt-5"
                            style="color: white;font-size: 35px;font-weight: bold;">
                            <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                                class="text-4xl leading-none hover:text-gray-300">&times;
                            </button>
                        </div>
                        <div class="modal-body px-7 pb-7 w-fit"
                            style="display:flex;justify-content:center;align-items:center;">
                            <img :src="image" alt="poster" class="pt-5 pb-5" style="width:70%;">
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end movie-images -->

        <div class="movie-similar" style="padding-bottom:4rem;">
            <div class="container mx-auto px-10 py-16" style="max-width:1366px;">
                <h2 class="text-4xl font-semibold">Recommendations</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @if ($recommendations['recommendations']['results'])
                        @foreach ($recommendations['recommendations']['results'] as $movie)
                            @if ($loop->index < 5)
                                <div class="mt-8">
                                    <table class="shadow-lg shadow-orange-500" style="border-radius: 5%;">
                                        <tbody>
                                            <tr>
                                                <td class="products-container">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        style="width: 100%;">
                                                        <tbody>
                                                            <tr>
                                                                <td class="photo_hoverpointProd"
                                                                    style="position: relative">
                                                                    <table border="0" cellpadding="0"
                                                                        cellspacing="0" style="width: 100%;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="zoom_prod"
                                                                                    style="height:345px;
                                                                            object-fit: cover;">
                                                                                    <a
                                                                                        href="{{ route('trend.show', $movie['id']) }}">
                                                                                        @if ($movie['poster_path'])
                                                                                            <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}"
                                                                                                alt="movie poster"
                                                                                                class="hover:scale-125 transition ease-in-out duration-50">
                                                                                        @else
                                                                                            <img src="/img/notfound.jpg"
                                                                                                alt="movie poster"
                                                                                                class="hover:opacity-80 transition ease-in-out duration-50"
                                                                                                style="width: 230px;height:345px;">
                                                                                        @endif
                                                                                    </a>
                                                                                    <table border="0"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0"
                                                                                        class="photo_prod"
                                                                                        style="width: 100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img src="/data/cms/images/trans.gif"
                                                                                                        style="width: 10px; height: 1px;" />
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div>
                                        <td>
                                            <img src="/data/cms/images/trans.gif"
                                                style="width: 10px; height: 10px;" />
                                        </td>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ route('trend.show', $movie['id']) }}"
                                            class="text-lg mt-2 hover:text-gray:300">{{ $movie['title'] }}</a>
                                        <div class="flex items-center text-gray-400 text-sm mt-1">
                                            <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                                                <g data-name="Layer 2">
                                                    <path
                                                        d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                                                        data-name="star" />
                                                </g>
                                            </svg>
                                            <span
                                                class="ml-1">{{ number_format($movie['vote_average'], 2) }}</span>
                                            <span class="mx-2">|</span>
                                            <span>{{ $movie['release_date'] }}</span>
                                        </div>
                                    </div>
                                    <div class="text-gray-400 text-sm">
                                        @foreach ($movie['genre_ids'] as $genre)
                                            {{ $genres->get($genre) }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @else
                            @break
                        @endif
                    @endforeach
                @else
                    @foreach ($similar['similar']['results'] as $movie)
                        @if ($loop->index < 5)
                            <div class="mt-8">
                                <table class="shadow-lg shadow-orange-500" style="border-radius: 5%;">
                                    <tbody>
                                        <tr>
                                            <td class="products-container">
                                                <table border="0" cellpadding="0" cellspacing="0"
                                                    style="width: 100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="photo_hoverpointProd"
                                                                style="position: relative">
                                                                <table border="0" cellpadding="0"
                                                                    cellspacing="0" style="width: 100%;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="zoom_prod"
                                                                                style="height:345px;
                                                                            object-fit: cover;">
                                                                                <a
                                                                                    href="{{ route('trend.show', $movie['id']) }}">
                                                                                    @if ($movie['poster_path'])
                                                                                        <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}"
                                                                                            alt="movie poster"
                                                                                            class="hover:scale-125 transition ease-in-out duration-50">
                                                                                    @else
                                                                                        <img src="/img/notfound.jpg"
                                                                                            alt="movie poster"
                                                                                            class="hover:opacity-80 transition ease-in-out duration-50"
                                                                                            style="width: 230px;height:345px;">
                                                                                    @endif
                                                                                </a>
                                                                                <table border="0"
                                                                                    cellpadding="0"
                                                                                    cellspacing="0"
                                                                                    class="photo_prod"
                                                                                    style="width: 100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <img src="/data/cms/images/trans.gif"
                                                                                                    style="width: 10px; height: 1px;" />
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <td>
                                        <img src="/data/cms/images/trans.gif"
                                            style="width: 10px; height: 10px;" />
                                    </td>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('trend.show', $movie['id']) }}"
                                        class="text-lg mt-2 hover:text-gray:300">{{ $movie['title'] }}</a>
                                    <div class="flex items-center text-gray-400 text-sm mt-1">
                                        <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                                            <g data-name="Layer 2">
                                                <path
                                                    d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                                                    data-name="star" />
                                            </g>
                                        </svg>
                                        <span
                                            class="ml-1">{{ number_format($movie['vote_average'], 2) }}</span>
                                        <span class="mx-2">|</span>
                                        <span>{{ $movie['release_date'] }}</span>
                                    </div>
                                </div>
                                <div class="text-gray-400 text-sm">
                                    @foreach ($movie['genre_ids'] as $genre)
                                        {{ $genres->get($genre) }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @else
                        @break
                    @endif
                @endforeach
            @endif
        </div>
    </div> <!-- end movie-recommend -->
</div>
</div>
@endsection
