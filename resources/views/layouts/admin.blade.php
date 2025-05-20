<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            background-color: #343a40;
        }

        .sidebar-heading {
            font-size: 1.5rem;
            background-color: #212529;
        }

        .list-group-item {
            border: none;
        }

        .list-group-item:hover {
            background-color: #495057;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .btn-outline-danger {
            border-radius: 50px;
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-dark" id="sidebar-wrapper">
            <div class="sidebar-heading text-white p-4 fw-bold border-bottom border-secondary">
                <i class="fas fa-shield-alt me-2"></i>Admin Panel
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="{{ route('admin.manageEvents') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-calendar-alt me-2"></i>Events
                </a>
                <a href="{{ route('admin.manageUsers') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-users me-2"></i>Users
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper" class="flex-grow-1">
            <nav class="navbar navbar-expand-lg border-bottom px-4">
                <div class="container-fluid justify-content-between">
                    <button class="btn btn-outline-primary" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <span class="me-2">Logged in as</span> 
                        <strong>{{ auth()->user()->name }}</strong>
                    </div>
                </div>
            </nav>

            <main class="container py-4">
                @yield('content')
            </main>
        </div>
    </div>
    <form method="POST" action="{{ route('logout') }}" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-outline-light btn-sm">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>
</form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar-wrapper').classList.toggle('d-none');
        });
    </script>
</body>
</html>