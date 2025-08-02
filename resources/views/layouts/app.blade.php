<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - School Sutra</title>

    <!-- CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ Nepali Date Picker CSS v5.0.5 -->
    <link href="https://nepalidatepicker.sajanmaharjan.com.np/v5/nepali.datepicker/css/nepali.datepicker.v5.0.5.min.css" rel="stylesheet" type="text/css"/>

    <style>
        body { background-color: #f0f4f8; }
        .sidebar {
            height: 100vh;
            background-color: #1e3a8a;
            color: white;
            padding-top: 1rem;
            position: fixed;
            width: 220px;
            overflow-y: auto;
        }
        .sidebar a, .sidebar .dropdown-item {
            color: white;
            text-decoration: none;
            display: block;
            padding: 0.75rem 1.25rem;
        }
        .sidebar a:hover, .sidebar .dropdown-item:hover {
            background-color: #1d4ed8;
        }
        .sidebar .active {
            background-color: #2563eb;
        }
        .content {
            margin-left: 220px;
            padding: 2rem;
        }
        .navbar {
            background-color: #3b82f6;
        }
        .navbar-brand, .navbar a {
            color: white !important;
        }
        .dropdown-menu {
            background-color: #1e3a8a;
            border: none;
            padding: 0;
        }
        .dropdown-item.active {
            background-color: #e7f1ff;
            border-left: 3px solid #0d6efd;
            color: #0d6efd !important;
        }
        .nepali-date-picker {
            z-index: 9999 !important;
        }
        @media (max-width: 767.98px) {
            .sidebar { transform: translateX(-100%); z-index: 1050; }
            .sidebar.active { transform: translateX(0); }
            .content { margin-left: 0; padding: 1rem; }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar" role="navigation">
            <h5 class="text-center mb-4"><i class="fas fa-school me-2"></i> School Sutra</h5>
            <nav>
                <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
                <a href="{{ route('sessions.index') }}" class="{{ request()->is('sessions*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt me-2"></i> Sessions
                </a>
                <a href="{{ route('students.index') }}" class="{{ request()->is('students*') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i> Students
                </a>
                <a href="{{ route('teachers.index') }}" class="{{ request()->is('teachers*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-teacher me-2"></i> Teachers
                </a>
                <a href="{{ route('classes.index') }}" class="{{ request()->is('classes*') ? 'active' : '' }}">
                    <i class="fas fa-layer-group me-2"></i> Classes & Sections
                </a>
                <a href="{{ route('subjects.index') }}" class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                    <i class="fas fa-book me-2"></i> Subjects
                </a>

                @php
                    $feeActive = request()->is('fee-types*') || request()->is('fee-structures*') || request()->is('payment-methods*') || request()->is('payments*');
                @endphp

                <div class="dropdown {{ $feeActive ? 'show' : '' }}">
                    <a href="#" class="dropdown-toggle d-block {{ $feeActive ? 'active text-white bg-primary' : '' }}" 
                       data-bs-toggle="dropdown" aria-expanded="{{ $feeActive ? 'true' : 'false' }}">
                        <i class="fas fa-money-bill-wave me-2"></i> Fees
                    </a>
                    <div class="dropdown-menu w-100 {{ $feeActive ? 'show' : '' }}">
                        <a href="{{ route('fee-types.index') }}" class="dropdown-item {{ request()->is('fee-types*') ? 'active' : '' }}">Fee Types</a>
                        <a href="{{ route('fee-structures.index') }}" class="dropdown-item {{ request()->is('fee-structures*') ? 'active' : '' }}">Fee Structures</a>
                        <a href="{{ route('payment-methods.index') }}" class="dropdown-item {{ request()->is('payment-methods*') ? 'active' : '' }}">Payment Methods</a>
                        <a href="{{ route('payments.index') }}" class="dropdown-item {{ request()->is('payments*') ? 'active' : '' }}">Payments</a>
                    </div>
                </div>

                <a href="#" class="{{ request()->is('attendance*') ? 'active' : '' }}">
                    <i class="fas fa-user-check me-2"></i> Attendance
                </a>
                <a href="#" class="{{ request()->is('exams*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list me-2"></i> Exams & Results
                </a>
                <a href="#" class="{{ request()->is('notice-board*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn me-2"></i> Notice Board
                </a>
                <a href="#" class="{{ request()->is('user-roles*') ? 'active' : '' }}">
                    <i class="fas fa-user-shield me-2"></i> User Roles
                </a>
                <a href="{{ route('logout') }}" class="d-block">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand navbar-light px-3 mb-4">
                <div class="container-fluid">
                    <button id="menuBtn" class="navbar-toggler d-md-none" type="button">
                        <i class="fas fa-bars"></i>
                    </button>
                    <span class="navbar-brand">
                        Welcome, {{ session('user') ?? 'Guest' }}
                        @if(isset($activeSession) && $activeSession)
                            | Active Session: <strong>{{ $activeSession->name }}</strong>
                        @else
                            | <span class="text-warning">Session not set</span>
                        @endif
                    </span>
                    <div class="ms-auto">
                        <a href="{{ route('logout') }}" class="nav-link">Logout</a>
                    </div>
                </div>
            </nav>

            <!-- Content -->
            @yield('content')
        </main>
    </div>

    @stack('scripts')

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ✅ Correct Nepali Datepicker v5.0.5 JS -->
    <script src="https://nepalidatepicker.sajanmaharjan.com.np/v5/nepali.datepicker/js/nepali.datepicker.v5.0.5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Sidebar toggle for mobile
            $('#menuBtn').click(function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
