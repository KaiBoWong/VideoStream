@extends('layouts.admin')

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
            margin-bottom: 20px;
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

    <div class="container mx-auto h-screen flex justify-center items-center" style="overflow: auto;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card custom-card">

                    <div class="flex justify-center items-center card-header" style="margin-bottom:20px;">
                        <svg class="h-10 w-10" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                                fill="#FF0000" stroke="#FF0000" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                                fill="#FF0000" />
                        </svg>
                        <span class="text-white font-semibold text-2xl">ADMIN DASHBOARD PAGE</span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <div class="row" style="padding-bottom:10px;">
                                <div class="text-center py-4"
                                    style="display:flex;justify-content:center;align-items:center;">
                                    <img src="/img/person.png" alt="dashboard" style="width:15%;">
                                </div>
                                <div class="text-white text-center py-4">

                                </div>
                            </div>
                            <div class="row">
                                <a href="{{ route('admin.list') }}" class="btn">{{ __('User List') }}</a>
                            </div>
                            <div class="row">
                                <a href="{{ route('admin.register') }}" class="btn">{{ __('Create User') }}</a>
                            </div>
                            <div class="row">
                                <a href="{{ route('admin.change_password') }}"
                                    class="btn">{{ __('Update User Password') }}</a>
                            </div>
                            <div class="row">
                                <a href="{{ route('admin.delete') }}" class="btn">{{ __('Delete User') }}</a>
                            </div>
                            <!--- <div class="row py-4">
                                                        <div style="display:flex;justify-content:center;align-items:center;">
                                                            <a href="{{ route('watch_history') }}" class="btn" style="width:200px;">
                                                                {{ __('Watch History') }}
                                                            </a>
                                                        </div>
                                                    </div> --->
                        </div>
                        @php
                            // Check if the 'visited' session variable is set
                            $visited = session('visited');

                            // Retrieve the username of the authenticated user
                            $username = auth()->user()->username;
                        @endphp

                        @if (!$visited)
                            {{-- Show content for the first visit --}}
                            <script>
                                alert("Welcome to the Admin page {{ $username }}!");
                            </script>
                        @else
                        @endif

                        {{-- Set 'visited' session variable to indicate that the user has visited the page --}}
                        @php
                            session(['visited' => true]);
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
