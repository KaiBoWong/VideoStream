@extends('layouts.admin')

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
    </style>
    <div class="container" style="height: 80vh;overflow: auto;padding-top:50px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card"
                    style="background-color:rgba(0, 0, 0, .5); border-color: #450A0A;box-shadow: 0 0 30px #450A0A;">
                    <div class="card-header" style="color:white;">{{ __('Change Password') }}</div>

                    <form method="POST" action="{{ route('admin.change_password.update') }}">
                        @csrf
                        <div class="card-body">

                            @if (session('success'))
                                <script>
                                    if (confirm("{{ session('success') }}")) {
                                        window.location.href = "{{ route('admin.change_password.update') }}";
                                    }
                                </script>
                            @endif

                            @if (session('error'))
                                <script>
                                    if (confirm("{{ session('error') }}")) {

                                    }
                                </script>
                            @endif

                            <div class="row mb-3 form-group" style="color:white;">
                                <label for="currentpassword"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input name="username" type="text"
                                            class="form-control @error('username') is-invalid @enderror"
                                            id="currentpassword" required autocomplete="username">

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 form-group">
                                <label for="new_password" class="col-md-4 col-form-label text-md-end"
                                    style="color: white;">{{ __('New Password') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="new_password" type="password"
                                            class="form-control @error('new_password') is-invalid @enderror"
                                            name="new_password" required x-autocomplete="off">
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword1"><i
                                                class="fas fa-eye"></i></button>

                                        @error('new_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('#togglePassword1').click(function() {
                                            var passwordField = $('#new_password');
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
                            <div class="row mb-3 form-group">
                                <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-end"
                                    style="color: white;">{{ __('Confirm New Password') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="new_password_confirmation" type="password"
                                            class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                            name="new_password_confirmation" required x-autocomplete="off">
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword2"><i
                                                class="fas fa-eye"></i></button>
                                        @error('new_password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('#togglePassword2').click(function() {
                                            var passwordField = $('#new_password_confirmation');
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
                            <div class="my-4"
                                style="width:100%;display:flex;justify-content:center;align-items:center;color:white;">
                                <button type="submit" class="btn">{{ __('Change Password') }}</button>
                                <div style="padding-left:20px;">
                                    <a href="{{ route('admin.users.index') }}" class="btn">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
