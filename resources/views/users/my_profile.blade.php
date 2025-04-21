@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Main Profile Container -->
    <div class="row">
        <!-- Left Column (Profile Image) -->
        <div class="col-md-4">
            <div class="card shadow-lg rounded-lg border-0">
                <div class="card-body text-center">
                    <img src="{{ asset('assets/img/faces/profile.png') }}" class="img-fluid rounded-circle shadow-lg border border-white" width="160" height="160">
                    <h4 class="mt-3 text-dark">{{ Auth::user()->name }}</h4>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- Right Column (User Info) -->
        <div class="col-md-8">
            <div class="card shadow-lg rounded-lg border-0">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="mb-0">User Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Full Name:</h6>
                            <p class="text-muted">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Email Address:</h6>
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Joined Date:</h6>
                            <p class="text-muted">{{ Auth::user()->created_at->format('Y-m-d') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Role:</h6>
                            <p class="text-muted">User</p> <!-- You can dynamically change this based on user role -->
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <a href="{{ route('profile.edit') }}" class="btn btn-gradient-primary btn-lg px-5 py-3 rounded-pill">Edit Profile</a>
                            <a href="{{ route('password.change') }}" class="btn btn-outline-primary btn-lg px-5 py-3 rounded-pill mt-3">Change Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inline CSS for Custom Styling -->
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .card-body {
        padding: 30px;
    }

    .card-header {
        background: linear-gradient(135deg, #007bff, #00c6ff);
        font-size: 1.25rem;
        font-weight: bold;
        border-radius: 15px 15px 0 0;
        padding: 20px;
    }

    h4 {
        font-size: 2rem;
        color: #333;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h5, h6 {
        color: #333;
    }

    p {
        color: #777;
        font-size: 1.1rem;
    }

    .btn {
        font-weight: bold;
        font-size: 1.2rem;
        transition: all 0.3s ease-in-out;
        border-radius: 50px;
        padding: 15px 30px;
    }

    .btn-gradient-primary {
        background: linear-gradient(135deg, #0066cc, #3399ff);
        border: none;
    }

    .btn-gradient-primary:hover {
        background: linear-gradient(135deg, #005bb5, #2671e2);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    .img-fluid {
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }

    .img-fluid:hover {
        transform: scale(1.1);
    }

    .container {
        max-width: 1200px;
    }
</style>
@endsection
