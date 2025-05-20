@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <!-- Logout Button at top right -->
    <div class="d-flex justify-content-end mb-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </button>
        </form>
    </div>

    <!-- Admin Alert -->
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <i class="fas fa-user-shield me-3 fa-lg"></i>
        <div>
            You are viewing the <strong>Admin Dashboard</strong> — Administrative privileges active.
        </div>
    </div>

    <!-- Dashboard Overview -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3"><i class="fas fa-chart-line me-2"></i>Dashboard Overview</h4>
            <div class="row g-4">
                <!-- Total Events -->
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h6 class="card-title">Total Events</h6>
                            <h3>{{ $events->count() }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h6 class="card-title">Total Users</h6>
                            <h3>{{ $users->count() }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Approved Events -->
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h6 class="card-title">Approved Events</h6>
                            <h3>{{ $events->where('is_approved', 1)->count() }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Pending Events -->
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-warning text-dark">
                        <div class="card-body">
                            <h6 class="card-title">Pending Events</h6>
                            <h3>{{ $events->where('is_approved', 0)->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Management Panels -->
    <div class="row g-4">
        <!-- Manage Events -->
        <div class="col-md-6 col-lg-6">
            <div class="card text-white bg-danger">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <h5 class="card-title"><i class="fas fa-calendar-alt me-2"></i>Manage Events</h5>
                        <p class="card-text">View, approve, or delete upcoming and past events.</p>
                    </div>
                    <a href="{{ route('admin.manageEvents') }}" class="btn btn-light btn-sm w-100 rounded-pill">
                        Go to Events Management
                    </a>
                </div>
            </div>
        </div>

        <!-- Manage Users -->
        <div class="col-md-6 col-lg-6">
            <div class="card text-white bg-primary">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <h5 class="card-title"><i class="fas fa-users me-2"></i>Manage Users</h5>
                        <p class="card-text">View, promote, or remove users and organizers.</p>
                    </div>
                    <a href="{{ route('admin.manageUsers') }}" class="btn btn-light btn-sm w-100 rounded-pill">
                        Go to Users Management
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection