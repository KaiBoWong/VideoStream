@extends('layouts.app')

@section('content')
    <style>
        /* Button Style */
        .btn {
            background-color: #8B0000;
            border-color: #8B0000;
            color: white;
            width: 200px;
            display: block;
            /* Ensure the button takes full width */
            margin: 0 auto;
            /* Center the button */
            margin-bottom: 30px;
            /* Add some bottom margin */
            text-align: center;
            /* Center text within the button */
            padding: 10px;
            /* Add padding */
            border-radius: 5px;
            /* Add border radius */
            transition: background-color 0.3s ease;
            /* Add smooth transition */
        }

        .btn:hover {
            background-color: #450A0A;
            border-color: #450A0A;
        }

        /* Custom Card Style */
        .custom-card {
            background-color: rgba(0, 0, 0, .5);
            border-color: #450A0A;
            box-shadow: 0 0 30px #450A0A;
        }

        .card-header {
            color: white;
            /* White text color */
            padding-top: 20px;
            font-size: 1.25rem;
            /* Larger font size */
            font-weight: bold;
            /* Bold font weight */
            text-align: center;
            /* Center-align text */
            text-transform: uppercase;
            /* Uppercase text */

        }

        .custom-body {
            padding: 4rem;
            /* Equivalent to p-16 */
            max-width: 42rem;
            /* Equivalent to max-w-2xl */
            width: 100%;
            /* Equivalent to w-full */
            background-color: #000;
            /* Equivalent to bg-black */
            box-shadow: 0 0 30px #450A0A;
            /* Equivalent to shadow-md */
            border-radius: 0.375rem;
            /* Equivalent to rounded-md */
            border-color: #450A0A;
            /* Inline style for border-color */
            border-width: 1px;
            /* If border is needed */
            border-style: solid;
            /* If border is needed */
        }

        .custom-card {
            color: white;
        }

        .custom-card .card-body {
            padding: 2rem;
            /* Adjust padding as needed */
        }
    </style>
    <div class='space-x-2 w-full shadow-md rounded-lg mx-auto container'
        style="background-color:rgba(0, 0, 0, .5); height: 80vh; overflow: auto; padding-top:50px;display:flex;justify-content:center;align-items:center;margin-bottom:50px;">
        <div class="card min-w-sm border transition-shadow shadow-xl hover:shadow-xl min-w-max"
            style="border-color: #450A0A; box-shadow: 0 0 30px #450A0A;">
            <div class="w-full card__media"><img src="/Rectangle 22.png" class="h-48 w-96"></div>
            <div class="card__media--aside"></div>
            <div class="flex items-center p-4">
                <div class="relative flex flex-col items-center w-full">
                    <div
                        class="h-24 w-24 md rounded-full relative avatar flex items-end justify-end text-purple-600 min-w-max absolute -top-16 flex bg-purple-200 text-purple-100 row-start-1 row-end-3 text-purple-650 ring-1 ring-white">
                        <img class="h-24 w-24 md rounded-full relative" src="/img/person.png" alt="">
                        <div class="absolute"></div>
                    </div>
                    <div class="flex flex-col space-y-1 justify-center items-center -mt-12 w-full text-white">
                        <span class="text-md whitespace-nowrap text-white font-semibold">{{ $user->username }}</span>
                        <span class="text-md whitespace-nowrap text-white">{{ $user->email }}</span>
                        <div class="row mb-3" style="color:white;display:flex;justify-content:center;align-items:center;">
                            <label class="text-md whitespace-nowrap text-white">{{ __('Registered Date') }}</label>
                            <div class="text-md whitespace-nowrap text-white" style="margin-left: 10px;"> <!-- Adjusted margin -->
                                {{ $user->created_at->format('M d, Y') }} <!-- Display formatted registered date -->
                            </div>
                        </div>
                        <div class="py-4 flex space-x-2">
                            <div style="padding-left:20px;">
                                <a href="{{ route('home') }}" class="btn">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
