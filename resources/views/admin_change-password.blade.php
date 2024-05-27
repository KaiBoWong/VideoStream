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
            margin-top: 30px;
            /* Add some bottom margin */
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

        .invalid-feedback {
            color: red;
            font-size: 14px;
        }

        .form-control.is-invalid {
            border-color: red;
        }
    </style>
    <div class="flex justify-center items-center h-screen px-6" style="margin-bottom:50px;">
        <div class="p-16 max-w-2xl w-full bg-black shadow-md rounded-md"
            style="border-color: #450A0A;box-shadow: 0 0 30px #450A0A;">
            <div class="flex justify-center items-center" style="margin-bottom:20px;">
                <svg class="h-10 w-10" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                        fill="#FF0000" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                        fill="#FF0000" />
                </svg>
                <span class="text-white font-semibold text-2xl">Change Password</span>
            </div>

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

                    <label for="username" class="block">
                        <div class="relative">
                            <input name="username" type="text"
                                class="text-white mt-1 block w-full px-3 py-2 border-b border-transparent bg-black focus:outline-none focus:border-red-400 form-control @error('username') is-invalid @enderror"
                                id="username" required autocomplete="username" placeholder="Username">
                        </div>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                    <label for="newpassword" class="block">
                        <div class="relative">
                            <input name="new_password" type="password"
                                class="text-white mt-1 block w-full px-3 py-2 border-b border-transparent bg-black focus:outline-none focus:border-red-400 form-control @error('new_password') is-invalid @enderror"
                                id="new_password" required autocomplete="new_password" placeholder="New Password"><i
                                class="fas fa-eye fa-lg absolute top-0 right-0 mt-3 mr-3 text-white hover:text-red-500 cursor-pointer"
                                id="togglePassword"></i>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#togglePassword').click(function() {
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
                        @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                    <label for="new_password_confirmation" class="block">
                        <div class="relative">
                            <input name="new_password_confirmation" type="password"
                                class="text-white mt-1 block w-full px-3 py-2 border-b border-transparent bg-black focus:outline-none focus:border-red-400 form-control @error('new_password_confirmation') is-invalid @enderror"
                                id="new_password_confirmation" required autocomplete="new_password_confirmation"
                                placeholder="New Password Confirmation"><i
                                class="fas fa-eye fa-lg absolute top-0 right-0 mt-3 mr-3 text-white hover:text-red-500 cursor-pointer"
                                id="togglePassword1"></i>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#togglePassword1').click(function() {
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
                        @error('new_password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                    <div class="my-4"
                        style="width:100%;display:flex;justify-content:center;align-items:center;color:white;">
                        <button type="submit" class="btn">{{ __('Change Password') }}</button>
                        <div style="padding-left:20px;">
                            <a href="{{ route('admin.users.index') }}" class="btn">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
