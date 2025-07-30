{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Dashboard') - School Sutra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f0f4f8;
        }

        .sidebar {
            height: 100vh;
            background-color: #1e3a8a;
            color: white;
            padding-top: 1rem;
            position: fixed;
            width: 220px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 0.75rem 1.25rem;
            transition: background 0.2s;
        }

        .sidebar a:hover {
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

        .navbar-brand {
            color: white !important;
            font-weight: bold;
        }

        .navbar a {
            color: white !important;
        }

        /* Responsive: Sidebar collapse on smaller screens */
        @media (max-width: 767.98px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }
            .content {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div>
        <div class="sidebar">
            <h5 class="text-center mb-4"><i class="fas fa-school"></i> School Sutra</h5>
            <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('sessions.index') }}" class="{{ request()->is('sessions*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i> Sessions
            </a>
            <a href="{{ route('students.index') }}" class="{{ request()->is('students*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Students
            </a>
            <a href="{{ route('teachers.index') }}" class="{{ request()->is('teachers*') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i> Teachers
            </a>
            <a href="{{ route('classes.index') }}" class="{{ request()->is('classes*') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i> Classes & Sections
            </a>


           <a href="{{ route('subjects.index') }}" class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                <i class="fas fa-book"></i> Subjects
             </a>



            <a href="#" class="{{ request()->is('attendance*') ? 'active' : '' }}">
                <i class="fas fa-user-check"></i> Attendance
            </a>
            <a href="#" class="{{ request()->is('exams*') || request()->is('fees*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list"></i> Exams & Fees
            </a>
            <a href="#" class="{{ request()->is('notice-board*') ? 'active' : '' }}">
                <i class="fas fa-bullhorn"></i> Notice Board
            </a>
            <a href="#" class="{{ request()->is('user-roles*') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i> User Roles
            </a>
            <a href="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>

        <div class="content">
            <nav class="navbar navbar-expand navbar-light px-4 mb-4">
    <span class="navbar-brand">
        Welcome, {{ session('user') ?? 'Guest' }}

        @if(isset($activeSession) && $activeSession)
            | Active Session: <strong>{{ $activeSession->name }}</strong>
        @else
            | <span class="text-warning">Session not set</span>
        @endif
    </span>
</nav>

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
