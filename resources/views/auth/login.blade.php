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

        .btn {
            cursor: pointer;
            border: none;
            background: none;
            outline: none;
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
    <div class="flex justify-center items-center h-screen px-6" style="height:100vh;">
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
                <span class="text-white font-semibold text-2xl">Login</span>
            </div>

            <form class="mt-4" method="POST" action="{{ route('login') }}">
                @csrf
                <label class="block">
                    <input id="username" type="text" name="username" placeholder="Username"
                        class="text-white mt-1 block w-full px-3 py-2 border-b border-transparent bg-black focus:outline-none focus:border-red-400"
                        value="{{ old('username') }}" required autocomplete="username" autofocus>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label>

                <label class="block mt-3">
                    <div class="relative">
                        <input id="password" type="password" name="password" placeholder="Password"
                            class="text-white mt-1 block w-full px-3 py-2 border-b border-transparent bg-black focus:outline-none focus:border-red-400"
                            value="{{ old('password') }}" required autocomplete="current-password" autofocus>
                        <i class="fas fa-eye fa-lg absolute top-0 right-0 mt-3 mr-3 text-white hover:text-red-500 cursor-pointer"
                            id="togglePassword"></i>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $('#togglePassword').click(function() {
                                var passwordField = $('#password');
                                var passwordFieldType = passwordField.attr('type');

                                if (passwordFieldType === 'password') {
                                    passwordField.attr('type', 'text');
                                    $(this).html('<i class="fa fa-eye-slash"></i>');
                                } else {
                                    passwordField.attr('type', 'password');
                                    $(this).html('<i class="fas fa-eye"></i>');
                                }
                            });
                        });
                    </script>

                    @error('password')
                        <span class="text-red-700 text-sm mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label>

                <div class="flex justify-between items-center mt-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="accent-red-500">
                            <span class="mx-2 text-white text-sm">Remember me</span>
                        </label>
                    </div>

                    <div style="display: inline-block;">
                        @if (Route::has('password.request'))
                            <a class="block text-sm fontme text-white hover:text-red-500 hover:underline"
                                style="margin-left:10px;" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="py-2 px-4 text-center bg-red-500 rounded-md w-full text-white text-sm hover:bg-red-700">
                        Sign in
                    </button>
                </div>
            </form>
            <div style="height:40px;">
            </div>
            <div style="width:100%;display:flex;justify-content:center;align-items:center;color:white;">
                <table style="width:100%;text-align:center;">
                    <tbody>
                        <tr>
                            <td style="width:35%;">
                                <div class="line"></div>
                            </td>
                            <td style="width:20%;">
                                <div style="text-align:center;">or</div>
                            </td>
                            <td style="width:35%;">
                                <div class="line"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="height:40px;">
            </div>
            <div style="width:100%;display:flex;justify-content:center;align-items:center;color:white;">
                <table style="width:100%;text-align:center;">
                    <tbody>
                        <tr>
                            <td>DON'T HAVE ACCOUNT?<a class="hover:text-red-500 text-white"
                                    style="font-weight:bold;margin-left:10px;text-decoration:underline;"
                                    href="{{ route('register') }}">REGISTER NOW</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="height:40px;">
            </div>
        </div>
    </div>
@endsection
