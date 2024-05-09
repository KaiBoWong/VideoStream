@extends('layouts.app')

@section('content')
<div class="container" style="height: 83vh;overflow: auto;">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
            </style>
            <div class="card" style="background-color:rgba(0, 0, 0, .5); border-color: #450A0A;box-shadow: 0 0 30px #450A0A; color:white;">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" method="post" action="{{ route('password.email') }}" class="btn">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
