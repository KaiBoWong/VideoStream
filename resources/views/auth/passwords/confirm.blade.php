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
            background-color: #450A0A; /* Set background color */
            color: white; /* Set text color */
            border-bottom: none; /* Remove bottom border */
            border-radius: 0; /* Remove border radius */
            font-weight: bold; /* Set font weight */
            text-align: center; /* Center align text */
            padding: 20px; /* Add padding */
        }

        .card-body {
            margin-top: 20px; /* Add margin top */
        }
</style>
<div class="container" style="height: 83vh;overflow: auto;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color:rgba(0, 0, 0, .5); border-color: #450A0A;box-shadow: 0 0 30px #450A0A; color:white;">
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
