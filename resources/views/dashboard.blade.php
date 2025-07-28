<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Dashboard</h1>

        <div class="row g-4">
            @php
                $modules = [
                    ['title' => 'Sessions', 'icon' => 'calendar-alt'],
                    ['title' => 'Students', 'icon' => 'users'],
                    ['title' => 'Teachers', 'icon' => 'chalkboard-teacher'],
                    ['title' => 'Classes & Sections', 'icon' => 'layer-group'],
                    ['title' => 'Subjects', 'icon' => 'book'],
                    ['title' => 'Attendance', 'icon' => 'user-check'],
                    ['title' => 'Exams & Fees', 'icon' => 'clipboard-list'],
                    ['title' => 'Notice Board', 'icon' => 'bullhorn'],
                    ['title' => 'User Roles', 'icon' => 'user-shield'],
                ];
            @endphp

            @foreach ($modules as $module)
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-{{ $module['icon'] }} fa-2x text-primary"></i>
                            </div>
                            <h5 class="mb-0">{{ $module['title'] }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
