@extends('layouts.admin')

@section('content')
<style>
    .btn{
        background-color:#8B0000;
        border-color: #8B0000;
        color:white;
    }
    a.btn:hover{
        background-color:#450A0A;
        border-color: #450A0A;
        color:white;
    }
</style>
    <div class="container" style="height: 85vh;overflow: auto;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="background-color:rgba(0, 0, 0, .5); border-color: #450A0A;box-shadow: 0 0 30px #450A0A;">
                    <div class="card-header" style="color:white;">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <div class="row" style="padding-bottom:10px;">
                                <div style="display:flex;justify-content:center;align-items:center;">
                                    <img src="/img/person.png" alt="dashboard" style="width:15%;">
                                </div>
                                <div style="color:white;text-align:center;" class="py-4">
                                    ADMIN PAGE
                                </div>
                            </div>
                            <div class="row">
                                <div style="display:flex;justify-content:center;align-items:center;">
                                    <a href="{{ route('admin.list') }}" class="btn" style="width:200px;">
                                        {{ __('User List') }}
                                    </a>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div style="display:flex;justify-content:center;align-items:center;">
                                    <a href="{{ route('admin.register') }}" class="btn" style="width:200px;">
                                        {{ __('Create User') }}
                                    </a>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div style="display:flex;justify-content:center;align-items:center;">
                                    <a href="{{ route('admin.change_password') }}" class="btn" style="width:200px;">
                                        {{ __('Update User Password') }}
                                    </a>
                                </div>
                            </div>
                            <div class="row py-4">
                                <div style="display:flex;justify-content:center;align-items:center;">
                                    <a href="{{ route('admin.delete') }}" class="btn" style="width:200px;">
                                        {{ __('Delete User') }}
                                    </a>
                                </div>
                            </div>
                            <!--- <div class="row py-4">
                                <div style="display:flex;justify-content:center;align-items:center;">
                                    <a href="{{ route('watch_history') }}" class="btn" style="width:200px;">
                                        {{ __('Watch History') }}
                                    </a>
                                </div>
                            </div> --->
                        </div>
                        @php
                            // Check if the 'visited' session variable is set
                            $visited = session('visited');

                            // Retrieve the username of the authenticated user
                            $username = auth()->user()->username;
                        @endphp

                        @if (!$visited)
                            {{-- Show content for the first visit --}}
                            <script>
                                alert("Welcome to the Admin page {{ $username }}!");
                            </script>
                        @else
                        @endif

                        {{-- Set 'visited' session variable to indicate that the user has visited the page --}}
                        @php
                            session(['visited' => true]);
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
