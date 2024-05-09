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
</style>
    <div class="container" style="height: 80vh;overflow: auto;padding-top:50px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card"
                    style="background-color:rgba(0, 0, 0, .5); border-color: #450A0A;box-shadow: 0 0 30px #450A0A;">
                    <div class="card-header" style="color:white;">
                        <h1>{{ __('User Profile') }}</h1>
                    </div>
                    <div class="row mb-3" style="color:white;">
                        <label class="col-md-4 col-form-label text-md-end align-self-center">{{ __('Username :') }}</label>
                        <div class="col-md-6 col-form-label">
                            {{ $user->username }}
                        </div>
                    </div>
                    <div class="row mb-3" style="color:white;">
                        <label class="col-md-4 col-form-label text-md-end">{{ __('Email :') }}</label>
                        <div class="col-md-6 col-form-label">
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="row mb-3" style="color:white;">
                        <label class="col-md-4 col-form-label text-md-end">{{ __('Registered Date :') }}</label>
                        <div class="col-md-6 col-form-label">
                            {{ $user->created_at->format('M d, Y') }} <!-- Display formatted registered date -->
                        </div>
                    </div>
                    <div class="row mb-3" style="color:white;">
                        <label class="col-md-4 col-form-label text-md-end">{{ __('Updated Date :') }}</label>
                        <div class="col-md-6 col-form-label">
                            {{ $user->updated_at->format('M d, Y') }} <!-- Display formatted registered date -->
                        </div>
                    </div>
                    <div class="my-4"
                        style="width:100%;display:flex;justify-content:center;align-items:center;color:white;">
                        <div style="padding-left:20px;">
                            <a href="{{ route('home') }}" class="btn">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
