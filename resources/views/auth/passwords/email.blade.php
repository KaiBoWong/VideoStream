@extends('layouts.app')

@section('content')
    <style>
        .line {
            width: 100%;
            /* Width of the line */
            height: 1px;
            /* Height of the line */
            background-color: white;
            /* Color of the line */
        }

        .form-input {
            padding: 2px;
            padding-left: 5px;
            padding-right: 5px;
            font-size: 16px;
        }

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
            margin-top: 20px;
            /* Add some bottom margin */
            margin-bottom: 10px;
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


        a.btn:hover {
            background-color: #450A0A;
            border-color: #450A0A;
            color: white;
        }

        .invalid-feedback {
            color: red;
            font-size: 14px;
        }

        .form-control.is-invalid {
            border-color: red;
        }

        .input-group {
            display: flex;
            align-items: center;
        }
    </style>
    <div class="flex justify-center items-center px-6" style="height:80vh;">
        <div class="p-16 max-w-2xl w-full bg-black shadow-md rounded-md"
            style="border-color: #450A0A;box-shadow: 0 0 30px #450A0A;">
            <div class="flex justify-center items-center">
                <svg class="h-10 w-10" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                        fill="#FF0000" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                        fill="#FF0000" />
                </svg>
                <span class="text-white font-semibold text-2xl">RESET PASSWORD</span>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="bg-green-500 text-white font-bold rounded-lg p-4 mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="row mb-3">
                        <label class="block">
                            <input id="email type="text" name="email" placeholder="Email Address"
                                class="text-white mt-10 block w-full px-3 py-2 border-b border-transparent bg-black focus:outline-none focus:border-red-400"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </label>
                    </div>

                    <div class="flex justify-center items-center mb-0">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <button style="width:250px;" type="submit"
                                class="btn mr-4">{{ __('Send Password Reset Link') }}</button>
                        </form>
                        <a style="width:100px;" href="{{ route('home') }}" class="btn">{{ __('Back') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
