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
        style="background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 70%), url('/Rectangle 22.png') repeat center top;">
        <div style="background-color: rgba(0, 0, 0, .5);padding-bottom:6rem;">
            <div class="container mx-auto" style="display: flex;flex-wrap: wrap;justify-content: center;max-width:1366px;">
                <div class="popular-movies px-10 pt-16">
                    @if (count($searchResults) > 0)
                        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">SEARCH RESULT :
                            {{ $search }}</h2>
                        <div style="padding-top:10px;border-bottom: 6px solid orange;width:150px;"></div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                            @foreach ($searchResults as $smovie)
                                @if ($loop->index < 30)
                                    <x-search-card :smovie="$smovie" :genres="$genres" :genrestv="$genrestv" />
                                @endif
                            @endforeach

                        </div>
                    @else
                        <div class="px-3 py-3" style="height: 60vh;">NO RESULT for "{{ $search }}"</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
