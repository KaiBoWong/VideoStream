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

        .btn {
            background-color: #8B0000;
            border-color: #8B0000;
            color: white;
        }

        a.btn:hover {
            background-color: #450A0A;
            border-color: #450A0A;
            color: white;
        }

        .btn:hover {
            background-color: #450A0A;
            /* Darker blue color on hover */
            color: white;
        }

        .reg {
            color: white;
        }

        a.reg:hover {
            color: #8B0000;
        }

        .form-check-input:checked {
            background-color: #8B0000;
            border-color: #8B0000;
        }

        /* Your existing custom CSS styles */
        /* Additional styles for the card header */
        .card-header {
            font-size:20px;
            background-color: #450A0A;
            /* Set background color */
            color: white;
            /* Set text color */
            border-bottom: none;
            /* Remove bottom border */
            border-radius: 0;
            /* Remove border radius */
            font-weight: bold;
            /* Set font weight */
            text-align: center;
            /* Center align text */
            padding: 20px;
            /* Add padding */
        }

        .card-body {
            margin-top: 40px;
            /* Add margin top */
        }

    </style>
    <div class="container" style="height: 83vh;overflow: auto;">
        <div class="row justify-content-center" style="display:flex;justify-content:center;align-items:center;">
            <div class="col-md-8">
                <div class="card"
                    style="background-color:rgba(0, 0, 0, .5); border-color: #450A0A;box-shadow: 0 0 30px #450A0A;">
                    <div class="card-header" style="color:white;">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3"
                                style="color:white;margin-bottom:20px;display:flex;justify-content:center;align-items:center;">
                                <label for="username"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="username"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3"
                                style="color:white;display:flex;justify-content:center;align-items:center;">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group" style="display:flex;justify-content:row;">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword"><i
                                                class="fas fa-eye"></i></button>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
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
                                                $(this).html('<i class="fa fa-eye"></i>');
                                            }
                                        });
                                    });
                                </script>
                            </div>

                            <div class="row mb-3"
                                style="color:white;margin-top:30px;display:flex;justify-content:center;align-items:center;">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check" style="display: inline-block;">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    <div style="display: inline-block;">
                                        @if (Route::has('password.request'))
                                            <a style="margin-left:10px;" class="btn"
                                                href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4" style="margin-top:20px;">
                                <div style="display:flex;justify-content:center;align-items:center;">
                                    <button type="submit" class="btn" style="width:100px;">
                                        {{ __('Login') }}
                                    </button>

                                </div>
                            </div>
                        </form>
                        <div style="height:40px;">
                        </div>
                        <div style="width:100%;display:flex;justify-content:center;align-items:center;color:white;">
                            <table style="width:60%;text-align:center;">
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
                            <table style="width:60%;text-align:center;">
                                <tbody>
                                    <tr>
                                        <td>DON'T HAVE ACCOUNT?<a class="reg" style="margin-left:10px;"
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
            </div>
        </div>
    </div>
@endsection
