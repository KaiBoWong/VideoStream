@extends('layouts.app')

@section('content')
<style>
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
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
