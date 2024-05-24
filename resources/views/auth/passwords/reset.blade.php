@extends('layouts.app')

@section('content')
    <style>
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

        /* Your existing custom CSS styles */
        /* Additional styles for the card header */
        .card-header {
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
            margin-top: 20px;
            /* Add margin top */
        }
    </style>
    <div class="container" style="height: 83vh;overflow: auto;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card"
                    style="background-color:rgba(0, 0, 0, .5); border-color: #450A0A;box-shadow: 0 0 30px #450A0A; color:white;">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <div class="card-body">

                                @if (session('success'))
                                    <script>
                                        if (confirm("{{ session('success') }}")) {
                                            window.location.href = "{{ route('home') }}";
                                        }
                                    </script>
                                @endif

                                @if (session('error'))
                                    <script>
                                        if (confirm("{{ session('error') }}")) {

                                        }
                                    </script>
                                @endif

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3" style="color:white;">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="new-password">

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

                                <div class="row mb-3" style="color:white;">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input id="password-confirm" type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                name="password_confirmation" required autocomplete="new-password">

                                            <button type="button" class="btn btn-outline-secondary" id="togglePassword1"><i
                                                    class="fas fa-eye"></i></button>

                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            $('#togglePassword1').click(function() {
                                                var passwordField = $('#password-confirm');
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


                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4" style="display:flex;">
                                        <button type="submit" class="btn">
                                            {{ __('Reset Password') }}
                                        </button>
                                        <div style="padding-left:20px;">
                                            <a href="{{ route('home') }}" class="btn">{{ __('Back') }}</a>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
