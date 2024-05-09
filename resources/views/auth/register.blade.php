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
            border-color: #450A0A;
            color: white;
        }
    </style>
    <div class="container" style="height: 80vh;overflow: auto;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card"
                    style="background-color:rgba(0, 0, 0, .5); border-color: #450A0A;box-shadow: 0 0 30px #450A0A;">
                    <div style="color:white;" class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3" style="color:white;">
                                <label for="username"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3" style="color:white;">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

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

                            <div class="row mb-3" style="color:white;">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror"
                                            name="password_confirmation" required autocomplete="new-password">

                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword1"><i
                                                class="fas fa-eye"></i></button>

                                        @error('password-confirm')
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
                            <div class="row mb-4 mt-4">
                                <div class="col-md-6 offset-md-4"
                                    style="display:flex;justify-content:center;align-items:center;">
                                    <button type="submit" class="btn btn-primary" style="width:150px;">
                                        {{ __('Register') }}
                                    </button>
                                    <div style="padding-left:30px;">
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
